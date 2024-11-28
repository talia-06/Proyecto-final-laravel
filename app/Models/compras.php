<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;

    protected $table = 'compras'; 

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
    ];

    public function proveedores()
    {
        return $this->belongsTo(proveedores::class, 'proveedor_id');
    }
}
