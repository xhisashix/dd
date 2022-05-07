<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'user_id', 'content', 'thumbnail', 'status', 'categories_id'];

    /**
     * postsテーブルとusersテーブルのリレーション
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    /**
     * postsテーブルとcategoriesテーブルのリレーション
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id', 'id');
    }
}
