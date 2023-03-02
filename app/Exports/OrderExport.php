<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class OrderExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($invoice_number)
    {
        $this->invoice_number = $invoice_number;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["Invoice Number", "Product Id", "Qty", "Subtotal", "Total"];
    }

    public function collection()
    {
        return Order::select('invoice_number', 'product_id', 'qty', 'subtotal', 'total')->where('invoice_number', $this->invoice_number)->get();
    }
}
