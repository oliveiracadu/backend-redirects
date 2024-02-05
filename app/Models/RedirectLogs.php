<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectLogs extends Model
{
    use HasFactory;

    protected $table = 'redirect_logs';

    protected $fillable = [
        'code',
        'ip',
        'user_agent',
        'header_referer',
        'query_params'
    ];

    public $timestamps = true;
}
