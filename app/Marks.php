<?php

namespace App;

use App\User;
use App\Matiere;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
   protected $guarded=[''];
   public function user(){
       return $this->belongsTo(User::class);
   }
   public function matiere(){
       return $this->belongsTo(Matiere::class);
   }
}
