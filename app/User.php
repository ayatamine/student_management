<?php

namespace App;

use App\Marks;
use App\Classes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','s_id','class_id','absence_number','state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function class(){
        return $this->belongsTo(Classes::class);
    }
    public function marks(){
        return $this->hasMany(Marks::class,'student_id');
    }
    public function marksAverage(){
        if(!$this->class){
            return array('cofficient_sum'=>0,'result'=>0) ;

        }
      $tot =0;$cofficient_sum = 0;
       foreach ($this->marks as $mark) {
           $cofficient_sum += $mark->matiere->cofficient;
           $tot += $mark->matiere->cofficient * $mark->mark;

       }
       $cofficient_sum = $cofficient_sum > 0 ? $cofficient_sum : 1;      
       return array('cofficient_sum'=>$cofficient_sum,'result'=>round($tot / $cofficient_sum,2)) ;
    }
    public function absencePercentage(){
        if(!$this->class){return 0;}
        return
        ($this->absence_number * 100) / ($this->class->max_absence_number > 0 ?
         $this->class->max_absence_number : 1);
    }

}
