<?php

namespace App\Exports;

use App\Models\DetailSale;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;

class SaleExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection()
    {
        return DetailSale::selectRaw('sales.id, customers.name as customer_name, customers.address as customer_address, customers.phone as customer_phone, sales.sale_date, sales.total_price, users.name as user_name, products.name as product_name, products.price as product_price, detail_sales.amount, detail_sales.amount * products.price as subtotal')
            ->join('sales', 'detail_sales.sale_id', '=', 'sales.id')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('products', 'detail_sales.product_id', '=', 'products.id')
            ->get();
    }

    private $index = 0;

    public function map($sale): array
    {
        return [
            ++$this->index,
            $sale->customer_name,
            $sale->customer_address,
            $sale->customer_phone,
            $sale->product_name,
            'Rp ' . number_format($sale->product_price, 2, '.', ','),
            'Rp ' . number_format($sale->subtotal, 2, '.', ','),
            $sale->sale_date,
            $sale->user_name,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Customer Name',
            'Customer Address',
            'Customer Phone',
            'Product Name',
            'Product Price',
            'Subtotal',
            'Sale Date',
            'Created By',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}
