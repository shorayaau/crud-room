<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table ='transaction_details';
    protected $primaryKey = 'trans_id';

    protected $fillable = [
        'trans_id',
        'room_id',
        'days',
        'subtotal_rooms',
        'extra_charge',
    ];
}
