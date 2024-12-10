<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class ProductController extends Controller
{

    public function index()
    {
        $datas = Product::where('deleted_at', null)->get(); 
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->productCategory;
            }
        }
        return response()->json($datas, 200);
    }

    public function getById($id){
        $product = Product::where('id', '=', $id)->first();
        return response()->json($product, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['product_category_id'])) {
                throw new CustomException('Please provide product_category_id.', 400, 'invalid_request');
            }
            if (!isset($input['product_name'])) {
                throw new CustomException('Please provide product_name.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $product = new Product();
            $product->product_category_id = $input['product_category_id'];
            $product->product_name = $input['product_name'];
            if (isset($input['product_code'])) {
                $product->product_code = $input['product_code'];
            }
            if (isset($input['product_quantity'])) {
                $product->product_quantity = $input['product_quantity'];
            }
            $product->save();

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
            if (!isset($input['product_category_id'])) {
                throw new CustomException('Please provide product_category_id.', 400, 'invalid_request');
            }
            if (!isset($input['product_name'])) {
                throw new CustomException('Please provide product_name.', 400, 'invalid_request');
            }
            $product = Product::find($id);
            if (!isset($product)) {
                throw new CustomException('product not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            $product->product_category_id = $input['product_category_id'];
            $product->product_name = $input['product_name'];
            if (isset($input['product_code'])) {
                $product->product_code = $input['product_code'];
            }else{
                $product->product_code = "";
            }
            if (isset($input['product_quantity'])) {
                $product->product_quantity = $input['product_quantity'];
            }else{
                $product->product_quantity = "";
            }
            $product->save();

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

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            
            DB::select(DB::raw("UPDATE tb_product 
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
