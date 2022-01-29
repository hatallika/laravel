<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function getCategories()
    {
        return \DB::table($this->table)
            ->select('id', 'title', 'description')
            ->get()
            ->toArray();
    }

    public function getCategoryById(int $id)
    {
        return \DB::table($this->table)->find($id);
    }


}
