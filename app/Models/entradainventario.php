<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entradainventario extends Model
{
    use HasFactory;

    protected $table = 'entradainventario'; 

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
    ];
}
