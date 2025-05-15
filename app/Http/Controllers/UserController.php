<?php

namespace App\Http\Controllers;

use App\UserTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;

class UserController extends Controller
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

            $emailToCheck = UserTable::where('email', $input['email'])->first();
            if ($emailToCheck) {
                throw new CustomException('อีเมลนี้มีในระบบแล้ว', 400, 'duplicate_email');
            }
            if(strlen($input['password']) > 8){
                throw new CustomException('รหัสผ่านต้องไม่เกิน 8 ตัว', 400, 'Password_over 8 digit');
            }

            DB::beginTransaction();
            $emp = new UserTable();
            if (isset($input['username'])) {
                $emp->username = $input['username'];
            }
            $emp->email = $input['email'];
            
            $emp->password = md5($input['password']);
            
            if (isset($input['rol'])) {
                $emp->rol = $input['rol'];
            }
            
            
            $emp->status = 'A';
            // $emp->created_by = 'Prawit';
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
            $user = User::where('email', '=', $email)->where('password', $hashedPassword)->firstOrFail(); // เช็ค email และ password ว่ามีอยู่ในระบบ

            $response = [
                'code' => 'success',
                'data' => $user
            ];
            return response()->json($response, 200);
            
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), 500);
        }
    }
    
}
