<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Product;

class CodeGenerator
{
    //generate code
    public static function generateAlphaNumericCode(string $prefix = 'PR', int $length = 8): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLength = max(0, $length - strlen($prefix));
        $random = '';

        for ($i = 0; $i < $randomLength; $i++) {
            $random .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $prefix . $random;
    }

    //code Unique
    public static function generateUniqueProductCode(string $prefix = 'PR', int $length = 8): string
    {
        do {
            $code = self::generateAlphaNumericCode($prefix, $length);
        } while (Product::where('product_code', $code)->exists());

        return $code;
    }

    //generate order code
    public static function generateUniqueOrderCode(string $prefix = 'OR', int $length = 8): string
    {
        do {
            $code = self::generateAlphaNumericCode($prefix, $length);
        } while (Order::where('invoice_no', $code)->exists());

        return $code;
    }
}
