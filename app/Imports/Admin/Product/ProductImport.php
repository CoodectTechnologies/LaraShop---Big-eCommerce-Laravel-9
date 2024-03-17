<?php

namespace App\Imports\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProductImport implements ToModel, WithBatchInserts, WithChunkReading, WithUpserts, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        return new Product([
            'user_id' => Auth::id(),
            'name' => $row['nombre'],
            'slug' => strtolower(str_replace(' ', '', $row['nombre'])),
            'detail' => $row['detalle'],
            'description' => $row['descripcion'],
            'quantity' => $row['cantidad'],
            'sku' => $row['sku'],
            'price' => $row['precio'],
            'featured' => $row['destacado'] ? true : false,
            'iframe_url' => $row['iframe_youtube'],
            'meta_title' => $row['nombre'],
            'meta_description' => $row['detalle'],
            'meta_keywords' => $row['detalle'],
        ]);
    }
    public function batchSize(): int{
        return 1000;
    }
    public function chunkSize(): int{
        return 1000;
    }
    public function uniqueBy(){
        return 'name';
    }
}
