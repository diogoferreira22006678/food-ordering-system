<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Table extends Model
{

    public function getQrCodeAttribute()
    {
        return QrCode::size(200)->generate(route('table.view', $this->id));
    }

}
