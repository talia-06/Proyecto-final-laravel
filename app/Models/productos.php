<?php

namespace App\Models;
use App\Models\categorias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    public function categoria()
    {
        return $this->belongsTo(categorias::class, 'categoria_id');
    }
}
