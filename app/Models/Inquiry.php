<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  お問い合わせ
 * ===============================
 */
class Inquiry extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','gest_name','gest_email','body',
    ];
}
