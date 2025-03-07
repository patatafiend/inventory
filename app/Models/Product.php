<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'category_id',
        'unit_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
