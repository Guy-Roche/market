<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeGeneratorService
{
    public function generate(string $data, int $size = 100): string
    {
        return QrCode::size($size)->generate($data);
    }
}
