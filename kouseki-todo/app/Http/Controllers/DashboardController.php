<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //filter data di database -> where('column', 'perbandingan', 'value')
        //get()-> ambil data
        //filter data di table todos yang isi column user_id nya sama dengan data history login bagian id
        $todos = Todo::where('user_id', Auth::user()->id)->where('status', 0)->get();
        return view('dashboard.index', compact('todos'),[
            'title' => 'Dashboard',
        ]);
    }
}
