<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        public function index()
        {
            $user=User::count();
            $blog=Blog::count();
            $category=Blogcategory::count();
            return view('admin.dashboard.index',compact('user','blog','category'));
        }
    }