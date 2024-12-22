<?php

use Filament\Facades\Filament;

function filament_user_id(): int|string|null
{
    return Filament::auth()->id();
}
