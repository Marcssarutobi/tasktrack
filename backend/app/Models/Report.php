<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ["prj_id","content"];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
