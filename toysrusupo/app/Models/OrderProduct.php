<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    #Hacemos referencia a la tabla order_product
    protected $table = 'order_product';

    #Definimos los campos que se pueden llenar
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

}
