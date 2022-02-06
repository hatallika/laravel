<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static $availableFields = ['id', 'title', 'url', 'description', 'created_at', 'active'];

    protected $fillable = [
        'id',
        'title',
        'description',
        'url',
        'active'
    ];
}
