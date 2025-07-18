<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItem;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship: One category has many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
