<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salidainventario extends Model
{
    use HasFactory;

    protected $table = 'salidainventario'; 

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
    ];
}
