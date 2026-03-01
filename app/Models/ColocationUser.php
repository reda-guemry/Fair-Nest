<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ColocationUser extends Pivot
{
    protected $table = 'colocation_user' ; 

    protected $fillable = [
        'user_id',
        'colocation_id',
        'role',
        'joined_at',
        'left_at',
        'status',
    ] ;

    protected function casts(): array
    {
        return [
            'joined_at' => 'date',
            'left_at' => 'date',
        ];
    }


    public function user() 
    {
        return $this -> belongsTo(User::class) ;
    }
    
    public function colocation()
    {
        return $this -> belongsTo(Colocation::class) ;
    }

    
}
