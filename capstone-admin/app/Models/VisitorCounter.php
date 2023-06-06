<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCounter extends Model
{
    use HasFactory;

    // Modelname::findOrCreate($id);
    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }
}
