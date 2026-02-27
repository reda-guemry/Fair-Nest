<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'reputation',
        'status',
        'reason',
        'is_global_admin' , 
    ];

    public function colocations()
    {
        return $this->belongsToMany(Colocation::class)
                    ->using(ColocationUser::class) 
                    ->withPivot(['id', 'role', 'joined_at', 'left_at', 'status']) 
                    ->withTimestamps();
    }

    public function paidExpenses()
    {
        return $this->hasMany(Expense::class, 'payer_id');
    }

    public function debts()
    {
        return $this->hasMany(Settlement::class, 'debtor_id');
    }
    public function credits()
    {
        return $this->hasMany(Settlement::class, 'creditor_id');
    }

    public function activeColocation() 
    {
        return $this ->colocations()->wherePivot('status' , 'active') ;
    }

    public function isFree() 
    {
        return $this -> activeColocation() -> doesntExist() ; 
    }

    public function isOwner($colocationId = null)
    {
        $coloc = $this->activeColocation()->where('colocation_id', $colocationId)->first(); ;
        // dd($coloc) ;
        return $coloc && $coloc->pivot->role === 'owner';
    }

    public function isMember()
    {
        $coloc = $this->activeColocation();
        return $coloc && $coloc->pivot->role === 'member';
    }

    public function sharedExpenses()
    {
        return $this->belongsToMany(Expense::class, 'expense_participants')
                    ->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
