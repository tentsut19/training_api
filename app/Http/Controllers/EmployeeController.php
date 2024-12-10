<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;

class EmployeeController extends Controller
{
    public function login(Request $request)
    {
        try {
            $input = $request->all();
            if (!isset($input['email'])) {
                throw new CustomException('Please provide email.', 400, 'invalid_request');
            }
            if (!isset($input['password'])) {
                throw new CustomException('Please provide password.', 400, 'invalid_request');
            }
            $email = $input['email'];
            $password = $input['password'];
            
            $employee = Employee::where('email', '=', $email)->where('password', $password)->firstOrFail();

            $response = [
                'code' => 'success',
                'data' => $employee
            ];
            return response()->json($response, 200);
            
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), 500);
        }
    }
    
}
