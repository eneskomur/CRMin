<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employees extends Controller
{
    function index()
    {
        //return view('employees');

        return view('employees', [
            'employees' => DB::table('employees')->paginate(10)
        ]);
    }

    function all() 
    {
        return view('employees', [
            'employees' => DB::table('employees')->paginate(DB::table('employees')->count()) //Counted the number of lines to avoid pagination errors
        ]);
    }
}
