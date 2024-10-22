<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WebsitePost;
use App\Models\User;
class EmailLog extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'email_logs';
    protected $fillable = ['website_post_id','user_id'];


    public function websitePost()
    {
        return $this->belongsTo(WebsitePost::class, 'website_post_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
