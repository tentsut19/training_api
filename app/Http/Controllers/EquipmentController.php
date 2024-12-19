<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use App\Exceptions\CustomException;

class EquipmentController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT pc.* FROM tb_equipment pc WHERE pc.deleted_at IS NULL ");
        return response()->json($data, 200);
    }

    public function getAll()
    {
        // $datas = Equipment::get(); 
        $datas = Equipment::where('deleted_at', '=', null)->get();
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->stock;
            }
        }
        return response()->json($datas, 200);
    }

    public function getById($id){
        $equipment = Equipment::where('id', '=', $id)->first();
        return response()->json($equipment, 200);
    }

    public function getByIdDetail($id){
        $equipment = Equipment::where('id', '=', $id)->first();
        $equipment->stock;
        return response()->json($equipment, 200);
    }

}
