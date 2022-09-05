<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    public function getReadableDuration(): string
    {
        return Str::of($this->duration_in_min)->append('min');
    }
}
