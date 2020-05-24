<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class authController extends Controller
{
    public function authenticate(){

        $username = request('user');
        $password = request('pass');
        $flag = 0;

        $employees = DB::table('employees')->get();


        foreach ($employees as $employee) {

            if ($username == $employee->username && $password == $employee->password){
                $flag = 1;
                break;
            }
        }

        if ($flag == 1){
            return view('staff_main_page');
        }
        else{
            return view('welcome');
        }
    }
}
?>