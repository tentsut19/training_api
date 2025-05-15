<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT pc.* 
        FROM tb_product_category pc 
        WHERE pc.deleted_at IS NULL ");

        return response()->json($data, 200);
    }

    public function indexAll()
    {
        $datas = ProductCategory::get(); 
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->productList;
            }
        }
        return response()->json($datas, 200);
    }

    public function getById($id){
        $productCategory = ProductCategory::where('id', '=', $id)->first();
        return response()->json($productCategory, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['category_name'])) {
                throw new CustomException('Please provide category_name.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $productCategory = new ProductCategory();
            $productCategory->category_name = $input['category_name'];
            $productCategory->save();

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

    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['category_name'])) {
                throw new CustomException('Please provide category_name.', 400, 'invalid_request');
            }
            $productCategory = ProductCategory::find($id);
            if (!isset($productCategory)) {
                throw new CustomException('productCategory not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            $productCategory->category_name = $input['category_name'];
            $productCategory->save();

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
            
            DB::select(DB::raw("UPDATE tb_product_category 
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
            $productCategory = ProductCategory::find($id);

            if (!isset($productCategory)) {
                throw new CustomException('ProductCategory not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();

            $productCategory->delete();

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
