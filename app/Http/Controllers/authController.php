<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class authController extends Controller
{
    public function authenticate(){

        $username = request('user');
        $password = request('pass');
        $flag = 0;

        $employees = Employee::all();


        foreach ($employees as $employee) {

            if ($username == $employee->username && $password == $employee->password){
                $flag = 1;
                break;
            }
        }

        if ($flag == 1){
            return redirect('student_management');
        }
        else{
            return view('welcome');
        }
    }
}
?>