<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
