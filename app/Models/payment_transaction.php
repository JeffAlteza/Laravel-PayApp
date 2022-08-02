<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens; 
use Illuminate\Notifications\Notifiable;

class payment_transaction extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_ref_no',
        'fullname',
        'email',
        'mobile_no',
        'amount',
        'payment_for',
        'date_of_trans',
        'payment_method',
        'paymaya_ref_no',
        'transaction_id',
        'status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];
    
}
