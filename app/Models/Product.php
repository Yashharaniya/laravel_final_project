<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'quantity',
        'price',
        'discount_price',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Adjust 'category_id' to match your foreign key column name
    }
}
?>