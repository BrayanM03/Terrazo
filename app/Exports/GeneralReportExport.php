<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Exports\CostExport;

class GeneralReportExport implements WithMultipleSheets
{
    use Exportable;

    protected $sheets;
    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;
        return $sheets;
    }


    public function sheets(): array
    {
       
        $hojas = [];
        array_push($hojas, new HistoryExport($this->sheets[0]));
        array_push($hojas, new CostsExport($this->sheets[1]));
        array_push($hojas, new TotalExport($this->sheets[2]));
      /*   for ($sheet = 1; $sheet <= 3; $sheet++) {
            $sheets[] = new HistoryExport();
        } */

        return $hojas;
    }

}
