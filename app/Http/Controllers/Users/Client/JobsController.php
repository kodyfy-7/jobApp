<?php

namespace App\Http\Controllers\Users\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Job;

use Validator;
use DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }


    public function index()
    {
        $cID = auth()->user()->id;
        $jobs = Job::whereClientId($cID)->get();
        return view('client.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::kebab($request->title);
        $slug = $slug.'-'.time();

        $job = Job::create([
            'job_title' => $request->input('title'),
            'category_id' => $request->input('category'),
            'job_description' => $request->input('content'),
            'job_slug' => $slug,
            'job_deadline' => $request->input('deadline'),
            'client_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Job has been created. Please note that its not public yet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //Check for correct user
        if(auth()->user()->id !== $job->client->id){
            return redirect()->back()->with('error', 'Unauthorized page!');
        }
        return view('client.job.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);

        //Update Job
        $job = Job::find($id);
        $job->job_title = $request->input('title');
        $job->category_id = $request->input('category');
        $job->job_description = $request->input('content');
        $job->save();

        return redirect()->back()->with('success', 'Vacancy has been edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if(auth()->user()->id !== $job->client->id){
            return redirect()->back()->with('error', 'Unauthorized page!');
        }

        $job->delete();
        return redirect()->back()->with('error', 'Vacancy Deleted');
    }

    public function publish(Request $request)
    {
        $form_data = array(
            'job_status'        =>  1
        );

        Job::whereId($request->hidden_job_id)->update($form_data);

        return redirect()->back()->with('success', 'Job published.');
    }

    public function unpublish(Request $request)
    {
        $form_data = array(
            'job_status'        =>  0
        );

        Job::whereId($request->hidden_job_id)->update($form_data);

        return redirect()->back()->with('success', 'Job unpublished.');
    }
}
