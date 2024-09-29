<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListSubworkload extends Model
{
    use HasFactory;
    protected $table = 'list_subworkloads';
    protected $fillable = ['name', 'description', 'subworkload_id', 'factor', 'create_by', 'sort_order', 'list_subworkloads_child_id'];
}
