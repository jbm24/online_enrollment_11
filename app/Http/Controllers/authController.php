<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Employee;

class authController extends Controller
{
    public function authenticate(){

        $username = request('user');
        $password = request('pass');
        $flag = 0;

        $employees = Employee::all();


        foreach ($employees as $employee) {

            if ($username == $employee->username && Hash::check('pass', $password)){
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