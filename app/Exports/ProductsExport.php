<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Product;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0;

    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'No', // Counter column
            'Name',
            'Quantity',
            'Price',
        ];
    }

    public function map($product): array
    {
        return [
            ++$this->counter,
            $product->name,
            $product->quantity,
            $product->price,
        ];
    }
}
