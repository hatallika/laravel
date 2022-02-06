<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public static $availableFields = ['id', 'title', 'description', 'created_at'];

    protected $fillable = [
        'id',
        'title',
        'description'
    ];

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }

    /*
    public function getCategories()
    {
        return \DB::table($this->table)
            ->select('id', 'title', 'description')
            ->get()
            ->toArray();
    }
    */
    /*
    public function getCategoryById(int $id)
    {
        return \DB::table($this->table)->find($id);
    }
    */


}
