<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use Request;//Illuminate\Http\Request; 
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Input;

use App\User;
use App\Job;
use App\Category;
use App\Resume;
use App\Application;

use App\Client;
use App\ClientProfile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search'/*, 'category'*/]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        $jobs = Job::orderBy('created_at', 'desc')->paginate(10);
        return view('welcome', compact('categories', 'jobs'));
    }

    public function home()
    {
        return view('user.dashboard');
    }

    public function show(Job $job)
    {
        $categories = Category::all();
        //$company_id = $job->client_id;
        $company = Client::find($job->client_id);
        //$company_profile = ClientProfile::whereClientId($job->client_id)->get();
        // if it doesnt work, move profile to main table
        //dd($company->logo);
        return view('view-job', compact('categories', 'job', 'company'));
    }

    public function search()
    {
            $categories = Category::all();
            $search = Request::input('search');
            $details = Job::where('job_title', 'LIKE', '%'.$search.'%')->orWhere('job_description', 'LIKE', '%'.$search.'%')->paginate(10);
            return view('search', compact('details', 'categories', 'search'));
          
    }

    public function upload(Request $request)
    {
        $job_id = Request::input('job_id');
        $appStatus = Application::whereJobId($job_id)->whereUserId(auth()->user()->id)->exists();
        if($appStatus) 
        {
            return redirect()->back()->with('error', 'Already applied.');
        } else
        {
            //Handle file upload
            if(Request::hasFile('cv_file')){
                // Get filename with the extension
                $filenameWithExt = $request->file('cv_file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('cv_file')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('cv_file')->storeAs('public/resumes', $fileNameToStore);

                $slug = Str::kebab($fileNameToStore);
                
                //Create Resume
                $resume = new Resume;
                $resume->resume_file = $fileNameToStore;
                $resume->user_id = auth()->user()->id;
                $resume->resume_status = Request::input('status');
                $resume->resume_slug = $slug;
                $resume->save();

                $form_data = array(
                    'resume_id'        =>  $resume->id
                );

                User::whereId(auth()->user()->id)->update($form_data);

                $slug_name = Str::kebab(auth()->user()->name);
                $slug_job = Str::kebab(Request::input('job_title'));
                $slug = $slug_name.'-'.$slug_job;

                //Create Application
                $application = new Application;
                $application->resume_id = $resume->id;
                $application->user_id = auth()->user()->id;
                $application->job_id = Request::input('job_id');
                $application->app_slug = $slug;
                $application->save();
            } else {

                $slug_name = Str::kebab(auth()->user()->name);
                $slug_job = Str::kebab(Request::input('job_title'));
                $slug = $slug_name.'-'.$slug_job;

                //Create Application
                $application = new Application;
                $application->resume_id = Request::input('resume');
                $application->user_id = auth()->user()->id;
                $application->job_id = Request::input('job_id');
                $application->app_slug = $slug;
                $application->save();
            }        
            // send application to company email with CV
            return redirect()->back()->with('success', 'You have successfully applied for this job, good luck.');
        } 
        
        
        
        
        
        
        
    }


}
