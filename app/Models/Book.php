<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // 允許更動欄位白名單
    protected $fillable = [
        'name',
        'author',
        'category',
        'ISBN',
        'pic',
        'book_status',
        'test2',
    ];
}
