<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class StockController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT pc.* FROM tb_stock pc WHERE pc.deleted_at IS NULL ");
        return response()->json($data, 200);
    }

    public function getById($id){
        $stock = Stock::where('id', '=', $id)->first();
        return response()->json($stock, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['stock_name'])) {
                throw new CustomException('Please provide stock_name.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $xxx = new Stock();
            $xxx->stock_code = $this->generateCode();
            $xxx->stock_name = $input['stock_name'];
            $xxx->created_by = 'system';
            $xxx->save();

            $response = [
                'code' => 'success',
                'data' => null
            ];  
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new CustomException($e->getMessage(), 500);
        }
    }

    public function generateCode()
    {
        // Get the last record's ID
        $lastRecord = Stock::latest('id')->first(); // ดึงข้อมูลที่ `id` ล่าสุด
        $lastId = $lastRecord ? $lastRecord->id : 0;
    
        // Increment to the next ID
        $nextId = $lastId + 1;
    
        // Format the code (pad with zeros)
        $code = str_pad($nextId, 3, '0', STR_PAD_LEFT);
    
        return 'S-' . $code;
    }

    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['stock_name'])) {
                throw new CustomException('Please provide stock_name.', 400, 'invalid_request');
            }
            $stock = Stock::find($id);
            if (!isset($stock)) {
                throw new CustomException('stock not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            $stock->stock_name = $input['stock_name'];
            $stock->save();

            $response = [
                'code' => 'success',
                'data' => null
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
            
            DB::select(DB::raw("UPDATE tb_stock 
                SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id "
                ),["id" => $id]);

            $response = [
                'code' => 'success',
                'data' => null
            ];
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new CustomException($e->getMessage(), 500);
        }
    }

    public function hardDelete($id)
    {
        try {
            DB::beginTransaction();
            
            $stock = Stock::find($id);

            if (!isset($stock)) {
                throw new CustomException('stock not found by id : '.$id.'.', 404, 'not_found');
            }

            $stock->delete();

            $response = [
                'code' => 'success',
                'data' => null
            ];
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollBack();
            throw new CustomException($e->getMessage(), 500);
        }
    }
}
