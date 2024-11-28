<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInventarioResumenView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW inventario_resumen AS
            SELECT 
                p.id AS producto_id,
                p.nombre AS nombre_producto,
                COALESCE(SUM(entrada.cantidad), 0) AS total_entradas,
                COALESCE(SUM(salida.cantidad), 0) AS total_salidas,
                COALESCE(SUM(entrada.cantidad), 0) - COALESCE(SUM(salida.cantidad), 0) AS existencia
            FROM 
                productos p
            LEFT JOIN 
                entradainventario entrada ON p.id = entrada.producto_id
            LEFT JOIN 
                salidainventario salida ON p.id = salida.producto_id
            GROUP BY 
                p.id, p.nombre;
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS inventario_resumen");
    }
}
