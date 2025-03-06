<?php

namespace App\Http\Controllers;

use App\CourseTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class CourseTableController extends Controller
{

    public function index()
    {
        $datas = CourseTable::where('deleted_at', null)->get(); 
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->userTable;
            }
        }
        return response()->json($datas, 200);
    }

    public function getById($id){
        $course = CourseTable::where('id', '=', $id)->first();
        return response()->json($course, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['course_name'])) {
                throw new CustomException('Please provide course_name.', 400, 'invalid_request');
            }
            if (!isset($input['teacher_id'])) {
                throw new CustomException('Please provide teacher_id.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $course = new CourseTable();
            $course->course_name = $input['course_name'];
            $course->detail = $input['detail'];
            if (isset($input['price'])) {
                $course->price = $input['price'];
            }
            if (isset($input['start_date'])) {
                $course->start_date = $input['start_date'];
            }
            if (isset($input['end_date'])) {
                $course->end_date = $input['end_date'];
            }
            $course->teacher_id = $input['teacher_id'];
            $course->save();

            $response = [
                'code' => 'success',
                'data' => $course
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
            // if (!isset($input['id'])) {
            //     throw new CustomException('Please provide id', 400, 'invalid_request');
            // }
            // if (!isset($input['course_name'])) {
            //     throw new CustomException('Please provide course_name.', 400, 'invalid_request');
            // }
            $course = CourseTable::find($id);
            if (!isset($course)) {
                throw new CustomException('course not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            // $course->id = $input['id'];
            $course->course_name = $input['course_name'];

            if (isset($input['detail'])) {
                $course->detail = $input['detail'];
            }else{
                $course->detail = "";
            }
            if (isset($input['price'])) {
                $course->price = $input['price'];
            }else{
                $course->price = "";
            }
            if (isset($input['start_date'])) {
                $course->start_date = $input['start_date'];
            }else{
                $course->start_date = "";
            }
            if (isset($input['end_date'])) {
                $course->end_date = $input['end_date'];
            }else{
                $course->end_date = "";
            }

            $course->save();

            $response = [
                'code' => 'success',
                'data' => $course
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
            
            DB::select(DB::raw("UPDATE course_table 
                SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id "
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
