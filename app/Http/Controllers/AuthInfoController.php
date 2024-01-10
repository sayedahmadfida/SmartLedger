<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AuthInfoController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('auth.auth_info', compact('categories'));
    }
}
