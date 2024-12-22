<?php

namespace App\Concerns;
use Illuminate\Database\Eloquent\Model;

trait ModelCreatedByAdmin
{
    public static function bootModelCreatedByAdmin(): void
    {
        $id = filament_user_id();

        self::creating(function (Model $record)use($id){
            $record->created_by_id = $id;
            $record->updated_by_id = $id;
        });

        self::updating(fn (Model $record) => $record->updated_by_id = $id);

        // self::deleting(function (Model $record) use ($id) {
        //     if (! $record->forceDeleting) {
        //         $record->updated_by_id = $id;
        //     }
        // });
    }

}
