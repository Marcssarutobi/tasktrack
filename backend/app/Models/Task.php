<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ["task_name","prj_id","assignTo","startDate","endDate","progress","status"];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'prj_id');
    }
}
