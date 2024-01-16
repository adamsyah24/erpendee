<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_desc',
    ];

    public function oProject()
    {
        return $this->hasMany(Order::class, 'project_id');
    }

    public function moProject()
    {
        return $this->hasMany(MediaOrder::class, 'project_id');
    }
}
