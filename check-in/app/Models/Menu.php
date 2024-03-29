<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'name', 'price', 'description', 'image', 'chef_recommendation'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_menu');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
