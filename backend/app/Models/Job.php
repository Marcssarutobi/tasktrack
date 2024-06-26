<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ["job_name","status","desc"];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
