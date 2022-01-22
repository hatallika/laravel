<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    public function getNews(): array
    {

        return \DB::table($this->table)
            ->select(['id', 'title', 'slug',  'author', 'status', 'description', 'category_id'])
            ->get()
            ->toArray();//преобразуем коллекцию в массив
    }


    public function getNewsById(int $id)
    {
        return \DB::table($this->table)->find($id);
    }

    public function getNewsByColumn( $column, $value)
    {
        return \DB::table($this->table)
            ->select(['id', 'title', 'slug',  'author', 'status', 'description', 'category_id'])
            ->where($column, '=' , $value)
            ->get()
            ->toArray();
    }

}
