<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'discription',
        'urgency',
        'status',
        'list_id',
        'created_at',
        'updated_at'
    ];

    public function todoList(){
        return $this->belongsTo('App\Models\TodoList', 'list_id', 'id');
    }
}
