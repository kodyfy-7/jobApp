<?php

namespace App\Http\Controllers\Users\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Job;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
        $cID = auth()->user()->id;
        $jobs = Job::whereClientId($cID)->get();
        $countJobs = count($jobs);
        return view('client.dashboard', compact('countJobs'));
    }

    
}