<?php
namespace App\Helpers;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;

class BarcodeHelper
{
    public static function generate(string $code, string $type = 'EAN13'): string
    {
        $generator = new BarcodeGeneratorSVG();

        $barcodeType = match(strtoupper($type)) {
            'EAN13' => $generator::TYPE_EAN_13,
            'CODE128' => $generator::TYPE_CODE_128,
            default => $generator::TYPE_CODE_128,
        };

        return 'data:image/png;base64,' . base64_encode(
            $generator->getBarcode($code, $barcodeType)
        );
    }
}
