<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;
class WebsitePost extends Model
{
    use HasFactory;

    protected $connection   = 'mysql';
    protected $table        = 'website_posts';
    protected $fillable     = ['website_id', 'title', 'title_slug','description','status'];


    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
}
