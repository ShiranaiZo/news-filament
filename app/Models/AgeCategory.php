<?php

namespace App\Models;

use App\Concerns\ModelCreatedByAdmin;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgeCategory extends Model
{
    use HasFactory, HasUlids, ModelCreatedByAdmin;

    protected $fillable = ['name', 'is_active', 'created_by_id', 'updated_by_id'];

    public function user(){
        return $this->belongsTo(User::class, "created_by_id");
    }
}
