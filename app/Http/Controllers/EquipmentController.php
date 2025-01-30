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
