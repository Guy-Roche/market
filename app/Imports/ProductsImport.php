<?php

namespace App\Imports;

use App\Helpers\CodeGenerator;
use App\Models\Product;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'category_id' => $row[1],
            'supplier_id' => $row[2],
            'product_code' => CodeGenerator::generateUniqueProductCode('PC', 12),
            'product_garage' => $row[4],
            'product_image' => $row[5],
            'product_store' => $row[6],
            'buying_date'     => $this->transformDate($row[7]), // ✅ conversion ici
            'expire_date'     => $this->transformDate($row[8]), // ✅ conversion ici
            'buying_price' => $row[9],
            'selling_price' => $row[10],
        ]);
    }

    //transforme date
    private function transformDate($value)
    {
        try {
            // Si c’est un nombre Excel, on le convertit
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }

            // Sinon on tente une conversion classique
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Ou log l’erreur si besoin
        }
    }
}
