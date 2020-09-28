<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Job;
use App\Resume;
use App\Application;
use App\Mail\SendCVToClient;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
    public function apply(Request $request)
    {
        $job_id = $request->input('job_id');
        $appStatus = Application::whereJobId($job_id)->whereUserId(auth()->user()->id)->exists();
        if($appStatus) 
        {
            return redirect()->back()->with('error', 'Already applied.');
        } else
        {
            if(auth()->user()->resume_id == null)
            {   
                $this->validate($request, [
                    'cv_file' => 'required|max:1999'
                ]);

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
                $resume->resume_status = 1;
                $resume->resume_slug = $slug;
                $resume->save();

                $form_data = array(
                    'resume_id'        =>  $resume->id
                );

                User::whereId(auth()->user()->id)->update($form_data);

                $slug_name = Str::kebab(auth()->user()->name);
                $slug_job = Str::kebab($request->input('job_title'));
                $slug = $slug_name.'-'.$slug_job;

                //Create Application
                $application = new Application;
                $application->resume_id = $resume->id;
                $application->user_id = auth()->user()->id;
                $application->job_id = $request->input('job_id');
                $application->app_slug = $slug;
                $application->save();
            } else
            {
                $this->validate($request, [
                    'cv_file' => 'max:1999'
                ]);
                //Handle file upload
                if($request->hasFile('cv_file')){
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
                    $resume->resume_status = $request->input('status');
                    $resume->resume_slug = $slug;
                    $resume->save();

                    if($request->input('status') == 1){
                        $form_data = array(
                            'resume_id'        =>  $resume->id
                        );

                        User::whereId(auth()->user()->id)->update($form_data);
                    }

                    $slug_name = Str::kebab(auth()->user()->name);
                    $slug_job = Str::kebab($request->input('job_title'));
                    $slug = $slug_name.'-'.$slug_job;

                    //Create Application
                    $application = new Application;
                    $application->resume_id = $resume->id;
                    $application->user_id = auth()->user()->id;
                    $application->job_id = $request->input('job_id');
                    $application->app_slug = $slug;
                    $application->save();
                } else {

                    $slug_name = Str::kebab(auth()->user()->name);
                    $slug_job = Str::kebab($request->input('job_title'));
                    $slug = $slug_name.'-'.$slug_job;

                    //Create Application
                    $application = new Application;
                    $application->resume_id = auth()->user()->resume_id;
                    $application->user_id = auth()->user()->id;
                    $application->job_id = $request->input('job_id');
                    $application->app_slug = $slug;
                    $application->save();
                }   
            }
                 $data = array(
                     'name' => auth()->user()->name,
                     'title' => $request->input('job_title'),
                 );

                 //Mail::to($request->input('cemail'))->send(new SendCVToClient($data) );
            // send application to company email with CV
            return redirect()->back()->with('success', 'You have successfully applied for this job, good luck.');
        } 
        
    }


}
