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
    protected $fillable     = ['website_post_uuid', 'website_id', 'title', 'title_slug','description','status'];


    /**
     * set UUID for website before creating record
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->website_post_uuid = str()->uuid()->toString();
        });
    }

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
}
