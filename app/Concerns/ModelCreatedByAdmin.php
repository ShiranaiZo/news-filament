<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;

trait ModelCreatedByAdmin
{
    public static function bootModelCreatedByAdmin(): void
    {
        $id = filament_user_id();
 
        self::creating(fn (Model $record) => $record->created_by_id = $id);
 
        self::updating(fn (Model $record) => $record->updated_by_id = $id);
    }    
}
