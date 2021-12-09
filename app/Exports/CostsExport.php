<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;


class CostsExport implements WithHeadings, FromArray, WithColumnWidths, WithStyles, WithDrawings, WithTitle//FromView //FromArray //FromCollection
{

    protected $invoices;

    public function __construct(array $invoices){
       
        $this->invoices = $invoices;
    }

    public function array(): array {

        
        return $this->invoices;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This terrazo logo');
        $drawing->setPath(public_path('/img/terraza_logo.png'));
        $drawing->setHeight(40);
        $drawing->setCoordinates('A2');

        return $drawing;
    }

  
    public function headings(): array { 

        return[
            ['','109 DOMINO DR N RUSKIN FL 33570'],
            ['', '(813)220-8933'],
            ['','JOSEJJTERRAZZOTILE.LLC@GMAIL.COM'], 
        ];
    }

    

   

    public function columnWidths(): array
    {
        return [
           'A' => 25,
            'B' =>35,   
            'D'=>12         
        ];
    }

    public function styles(Worksheet $sheet)
    {
        
        $sheet->getRowDimension(1)->setRowHeight(50);
   
        $sheet->mergeCells("C1:F1");
        $sheet->mergeCells("C2:F2");
        $sheet->mergeCells("C3:F3");
        $sheet->mergeCells("A8:E8");
        $sheet->mergeCells("B9:B10");
        $sheet->getStyle('B9')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('center');
        $sheet->getStyle('A8')->getAlignment()->setHorizontal('right');
        $sheet->getStyle('A8')->getAlignment()->setVertical('center');
        $sheet->getStyle('B2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B21')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B22')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B22')->getAlignment()->setVertical('center');
        $sheet->getStyle('B23')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B23')->getAlignment()->setVertical('center');
        return [
            // Style the first row as bold text.
            11    =>  ['font' => ['bold' => true]],
            "A13" => ['font' => ['bold' => true]],
            "A14" => ['font' => ['bold' => true]],
            "A15" => ['font' => ['bold' => true]],
            "A16" => ['font' => ['bold' => true]],
            "A17" => ['font' => ['bold' => true]],
            "A18" => ['font' => ['bold' => true], ['italic' => true]], ['size' =>15],
            "C5" => ['font' => ['bold' => true]],

            
        ];


    }

    public function title(): string
    {
        return 'COST';
    }

  /*   public function sheets(): array
    {
        $sheets = ["ORDER", 'COSTS', 'TOTAL'];

        return $sheets;
    } */

   
}

 /**
    * @return \Illuminate\Support\Collection
    */
    /* public function collection()
    {

        return History::all();
    } */