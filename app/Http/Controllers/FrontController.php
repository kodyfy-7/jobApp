<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Category;

class FrontController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    
    public function index()
    {
        $categories = Category::all();
        $jobs = Job::orderBy('created_at', 'desc')->paginate(10);
        return view('welcome', compact('jobs', 'categories'));
    }

    public function home()
    {
        return view('user.dashboard');
    }
}
