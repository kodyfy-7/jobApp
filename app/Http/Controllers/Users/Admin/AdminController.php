<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Client;
use App\Job;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();
        $clients = Client::all();
        $jobs = Job::all();
        $countUsers = count($users);
        $countJobs = count($jobs);
        $countClients = count($clients);

        return view('admin.dashboard', compact(['users', 'jobs', 'clients','countUsers', 'countClients', 'countJobs']));
    }

    public function show_user(User $user)
    {
        return view('admin.user.index', compact('user'));
    }

    public function destroy_user($id)
    {
        //return view('admin.user.index', compact('user'));
    }
}