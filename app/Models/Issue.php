<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    public function prescription(){
        return $this->hasMany(prescription::class,'issues_id','id');
    }
}
