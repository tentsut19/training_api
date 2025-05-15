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
    public function register(Request $request)
    {
        try {
            $input = $request->all();
            if (!isset($input['email'])) {
                throw new CustomException('Please provide email.', 400, 'invalid_request');
            }
            if (!isset($input['password'])) {
                throw new CustomException('Please provide password.', 400, 'invalid_request');
            }

            $emailToCheck = Employee::where('email', $input['email'])->first();
            if ($emailToCheck) {
                throw new CustomException('อีเมลนี้มีในระบบแล้ว', 400, 'duplicate_email');
            }
            if(strlen($input['password']) > 8){
                throw new CustomException('รหัสผ่านต้องไม่เกิน 8 ตัว', 400, 'duplicate_email');
            }

            DB::beginTransaction();
            $emp = new Employee();
            $emp->email = $input['email'];
            $emp->password = md5($input['password']);
            if (isset($input['gender'])) {
                $emp->gender = $input['gender'];
            }
            if (isset($input['prefix'])) {
                $emp->prefix = $input['prefix'];
            }
            if (isset($input['first_name'])) {
                $emp->first_name = $input['first_name'];
            }
            if (isset($input['last_name'])) {
                $emp->last_name = $input['last_name'];
            }
            if (isset($input['nick_name'])) {
                $emp->nick_name = $input['nick_name'];
            }
            if (isset($input['role'])) {
                $emp->role = $input['role'];
            }
            $emp->status = 'A';
            $emp->created_by = 'system';
            $emp->save();
 
            DB::commit();

            $response = [
                'code' => 'success',
                'data' => $emp
            ];
            return response()->json($response, 200);
            
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), 500);
        }
    }

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
            $hashedPassword = md5($password);
            $employee = Employee::where('email', '=', $email)->where('password', $hashedPassword)->firstOrFail(); // เช็ค email และ password ว่ามีอยู่ในระบบ

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
