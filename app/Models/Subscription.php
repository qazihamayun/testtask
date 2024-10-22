<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'subscriptions';
    protected $fillable = ['user_id','website_id'];



}
