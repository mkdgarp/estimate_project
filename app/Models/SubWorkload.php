<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubWorkload extends Model
{
    use HasFactory;
    protected $table = 'subworkloads';
    protected $fillable = ['name', 'description', 'workload_id'];

    
}
