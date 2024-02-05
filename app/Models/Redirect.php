<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'redirects';

    protected $fillable = [
        'code',
        'url',
        'query_params'
    ];

    public $timestamps = true;
}
