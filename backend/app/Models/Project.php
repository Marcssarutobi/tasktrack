<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ["name","assignTo","startDate","endDate","nbrTask","progress","status"];


    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'prj_id');
    }
    public function reports(){
        return $this->hasMany(Report::class, 'prj_id');
    }
}
