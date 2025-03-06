<?php

namespace App\Http\Controllers;

use App\ClassTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class ClassController extends Controller
{

    public function index()
    {
        $datas = ClassTable::where('deleted_at', null)->get(); 
        return response()->json($datas, 200);
    }
    public function getAll()
    {
        $datas = ClassTable::where('deleted_at', null)->get(); 
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->students;
                $data->course;
            }
        }
        return response()->json($datas, 200);
    }

    public function getById($id){
        $class = ClassTable::where('id', '=', $id)->first();
        return response()->json($class, 200);
    }

    public function getByIdDetail($id){
        $class = ClassTable::where('id', '=', $id)->first();
        $class->students;
        // $class->course;
        return response()->json($class, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            // if (!isset($input['class_id'])) {
            //     throw new CustomException('Please provide class_id.', 400, 'invalid_request');
            // }
            if (!isset($input['course_id'])) {
                throw new CustomException('Please provide course_id.', 400, 'invalid_request');
            }
            if (!isset($input['student_id'])) {
                throw new CustomException('Please provide student_id.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $class = new ClassTable();

            $class->course_id = $input['course_id'];
            $class->student_id = $input['student_id'];

            // if (isset($input['product_code'])) {
            //     $product->product_code = $input['product_code'];
            // }
            // if (isset($input['product_quantity'])) {
            //     $product->product_quantity = $input['product_quantity'];
            // }
            $class->status_c =0;
            $class->save();

            $response = [
                'code' => 'success',
                'data' => $class
            ];  
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new CustomException($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['course_id'])) {
                throw new CustomException('Please provide course_id.', 400, 'invalid_request');
            }
            if (!isset($input['student_id'])) {
                throw new CustomException('Please provide student_id.', 400, 'invalid_request');
            }
            $class = ClassTable::find($id);
            if (!isset($class)) {
                throw new CustomException('class not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            $class->course_id = $input['course_id'];
            // $class->status = $input['status'];
            if (isset($input['student_id'])) {
                $class->student_id = $input['student_id'];
            }else{
                $class->student_id = "";
            }
            // if (isset($input['product_quantity'])) {
            //     $product->product_quantity = $input['product_quantity'];
            // }else{
            //     $product->product_quantity = "";
            // }
            $class->status_c = 0;
            $class->save();

            $response = [
                'code' => 'success',
                'data' => $class
            ];  
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new CustomException($e->getMessage(), 500);
        }
    }

    public function softDelete($id)
    {
        try {
            
            
            DB::beginTransaction();

            // DB::select(DB::raw("UPDATE class_table 
            //     SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id "
            //     ),["id" => $id]);
            
            DB::select(DB::raw("UPDATE class_table 
                SET status_c = '4',deleted_at = CURRENT_TIMESTAMP WHERE id = :id "
                ),["id" => $id]);

            $response = [
                'code' => 'success',
                'data' => null
            ];
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), 500);
        }
    }

}
