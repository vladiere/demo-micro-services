<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $table = 'lists_table';
    protected $fillable =[
        'user_id',
        'list_name',
        'list_desc',
        'status',
    ];
}
