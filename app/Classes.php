<?php

namespace App;

use App\User;
use App\Classes;
use App\Matiere;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $guarded = [''];
    public function students(){
        return $this->hasMany(User::class,'class_id');
    }
    public function  matieres(){
        return $this->belongsToMany(Matiere::class, 'class_matieres', 'class_id', 'matiere_id');
    }
}
