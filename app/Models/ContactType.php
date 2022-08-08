<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * ===================================
 *  お問い合わせの種類
 * ===================================
 **/
class ContactType extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'value_text','code',
    ];

}
