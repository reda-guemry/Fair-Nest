<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colocation extends Model
{
    use HasFactory ;

    protected $fillable = [
        'name',
        'owner_id',
        'status',
    ];  



    // public function owner () 
    // {
    //     return $this -> belongsTo(User::class , 'owner_id') ; 
    // }

    public function members()
    {
        return $this->belongsToMany(User::class)
                    ->using(ColocationUser::class) 
                    ->withPivot(['id', 'role', 'joined_at', 'left_at', 'status'])
                    ->withTimestamps();
    }

}
