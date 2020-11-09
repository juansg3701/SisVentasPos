<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

//Se define una clase para interactuar con los campos de la tabla proveedor en la base de datos

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey='id_proveedor';
    public $timestamps =false;
    protected $fillable=['nombre_empresa', 'nombre_proveedor', 'direccion','telefono','correo','documento','verificacion_nit'];
    protected $guarded=[];

}
