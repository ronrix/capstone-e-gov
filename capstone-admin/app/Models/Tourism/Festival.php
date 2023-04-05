<?php

namespace App\Models\Tourism;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Festival extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
}
