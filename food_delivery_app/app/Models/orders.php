<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = "orders";
    use HasFactory;
}
/*
protected $casts = [
    'items' => 'json',
];
protected $fillable = ['item_details'];
*/