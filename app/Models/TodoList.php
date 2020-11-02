<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function getCases(){
        return $this->hasMany("App\Models\CaseItem", 'list_id', 'id');
    }
}
