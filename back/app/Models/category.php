<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * モデルに紐づくテーブル
     */
    protected $table = 'categories';

    /**
     * 代入する属性
     */
    protected $fillable = [
        'name',
        'user_id',
    ];
}
