<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Exports\EquipmentExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
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
        $datas = Equipment::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        if (isset($datas)) {
            foreach ($datas as &$data) {
                $data->stock;
            }
        }
        return response()->json($datas, 200);
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();
            $errorObj = [];
            $errors = array();
            if (!isset($input['equipment_name'])) {
                throw new CustomException('Please provide equipment_name.', 400, 'invalid_request');
            }

            DB::beginTransaction();
            $equipment = new Equipment();
            $equipment->stock_id = $input['stock_id'];
            if (isset($input['equipment_code'])) {
                $equipment->equipment_code = $input['equipment_code'];
            }
            if (isset($input['equipment_name'])) {
                $equipment->equipment_name = $input['equipment_name'];
            }
            if (isset($input['quantity'])) {
                $equipment->quantity = $input['quantity'];
            }
            if (isset($input['cost_price'])) {
                $equipment->cost_price = $input['cost_price'];
            }
            if (isset($input['selling_price'])) {
                $equipment->selling_price = $input['selling_price'];
            }
            $equipment->created_by = 'system';
            $equipment->save();

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
            if (!isset($input['equipment_name'])) {
                throw new CustomException('Please provide equipment_name.', 400, 'invalid_request');
            }
            $equipment = Equipment::find($id);
            if (!isset($equipment)) {
                throw new CustomException('equipment not found by id : '.$id.'.', 404, 'not_found');
            }

            DB::beginTransaction();
            $equipment->stock_id = $input['stock_id'];
            if (isset($input['equipment_code'])) {
                $equipment->equipment_code = $input['equipment_code'];
            }
            if (isset($input['equipment_name'])) {
                $equipment->equipment_name = $input['equipment_name'];
            }
            if (isset($input['quantity'])) {
                $equipment->quantity = $input['quantity'];
            }
            if (isset($input['cost_price'])) {
                $equipment->cost_price = $input['cost_price'];
            }
            if (isset($input['selling_price'])) {
                $equipment->selling_price = $input['selling_price'];
            }
            $equipment->save();

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

    public function getById($id){
        $equipment = Equipment::where('id', '=', $id)->first();
        return response()->json($equipment, 200);
    }

    public function getByIdDetail($id){
        $equipment = Equipment::where('id', '=', $id)->first();
        $equipment->stock;
        return response()->json($equipment, 200);
    }

    public function softDelete($id)
    {
        try {
            DB::beginTransaction();
            
            DB::select(DB::raw("UPDATE tb_equipment 
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
            
            $equipment = Equipment::find($id);

            if (!isset($equipment)) {
                throw new CustomException('equipment not found by id : '.$id.'.', 404, 'not_found');
            }
            
            $equipment->delete();

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

    public function exportExcel()
    {
        $datas = Equipment::where('deleted_at', '=', null)->get();
        return $this->export(new EquipmentExport($datas), 'equipment', 'xls');
    }

    private function export($class, $filename, $type)
    {
        if (! in_array($type, ['xls', 'csv'])) {
            $type = 'csv';
        }

        $fn = $filename.'-'.date('Y-m-d_H-i-s');

        return Excel::download($class, $fn.'.'.$type);
    }

    public function previewPDF()
    {
        $datas = Equipment::where('deleted_at', '=', null)->get();
        if (isset($datas)) {
            foreach ($datas as &$data) {
                if (isset($data->updated_at)) {
                    $dateTime = new \DateTime($data->updated_at);
                    $data->updated_time = $dateTime->format("d-m-Y");
                }
            }
        }

        $equipment = Equipment::where('id', '=', 1)->first();

        return view('equipment-template', ['datas' => $datas, 'eq1' =>  $equipment,'title' => 'Test PDF V1']);
    }

    public function previewPDFV2()
    {
        $datas = Equipment::where('deleted_at', '=', null)->get();
        if (isset($datas)) {
            foreach ($datas as &$data) {
                if (isset($data->updated_at)) {
                    $dateTime = new \DateTime($data->updated_at);
                    $data->updated_time = $dateTime->format("d-m-Y");
                }
            }
        }

        $equipment = Equipment::where('id', '=', 1)->first();

        return view('template', ['datas' => $datas, 'eq1' =>  $equipment,'title' => 'Test PDF V1']);
    }
    
    public function createPDF()
    {
        $datas = Equipment::where('deleted_at', '=', null)->get();
        if (isset($datas)) {
            foreach ($datas as &$data) {
                if (isset($data->updated_at)) {
                    $dateTime = new \DateTime($data->updated_at);
                    $data->updated_time = $dateTime->format("d-M-Y H:i:s");
                }
            }
        }
        $equipment = Equipment::where('id', '=', 1)->first();
        $pdf = PDF::loadView('equipment-template', ['datas' => $datas, 'eq1' =>  $equipment,'title' => 'Test PDF V1']);
        $pdf->setPaper('A4');
        // download PDF file with download method
        return $pdf->stream();
    }

}
