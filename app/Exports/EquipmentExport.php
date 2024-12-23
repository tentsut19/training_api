<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use JWTAuth;
use Illuminate\Support\Facades\Log;

class EquipmentExport implements FromCollection, WithHeadings, WithEvents {

    private $dataList;

    public function __construct($dataList) {
        $this->dataList = $dataList;
    }

    public function headings(): array
    {
        return [
            'ลำดับ', 'รหัสอุปกรณ์', 'ชื่ออุปกรณ์', 'จำนวน', 'ราคาต้นทุน', 'ราคาขาย'
        ];
    }

    public function registerEvents(): array
    {
        
        $styleArray = [
            
        ];

        return [
            AfterSheet::class    => function(AfterSheet $event) use ($styleArray)
            {
                $drawings = [];
                $no = 2;
                foreach ($this->dataList as $r) {
                    $no++;
                }

                $cellRange = 'A1:F'.$no;

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFFF00', // สีเหลือง (โค้ดสีในรูปแบบ ARGB)
                        ],
                    ],
                ]);

            },
        ];
    }

    public function collection()
    {
        $result = [];
        $no = 1;
        foreach ($this->dataList as $data) {
            $result[] = [$no++, $data->equipment_code, $data->equipment_name, $data->quantity, $data->cost_price, $data->selling_price];
        }
        Log::info($result);
        return collect($result);
    }

    public function startCell(): string
    {
        return 'A2';
    }

}