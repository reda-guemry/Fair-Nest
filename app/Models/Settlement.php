<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory ;


    protected $fillable = [
        'colocation_id',
        'debtor_id',
        'creditor_id',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

}
