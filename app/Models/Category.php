<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [
        'id', 'created_at'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
