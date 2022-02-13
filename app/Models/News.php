<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Builder;

class News extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'news';

    public static $availableFields = ['id', 'title', 'author', 'status', 'description', 'created_at', 'category_id', 'image'];

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'status',
        'description',
        'sources_id',
        'image'
    ];

    protected $casts = [
        'display' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sources(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'sources_id', 'id');
    }

    //protected $guarded = ['id'];



    /*public function getNewsByColumn( $column, $value)
    {
        return \DB::table($this->table)
            ->select(['id', 'title', 'slug',  'author', 'status', 'description', 'category_id'])
            ->where($column, '=' , $value)
            ->get()
            ->toArray();
    }
    */


    /*public function getTitleAttribute($value)
    {
        return mb_strtoupper($value);
    }*/


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}


