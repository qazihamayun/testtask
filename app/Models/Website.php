<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WebsitePost;
class Website extends Model
{
    use HasFactory;

    protected $connection   = 'mysql';
    protected $table        = 'websites';
    protected $fillable     = ['website_uuid', 'name','url'];


    /**
     * set UUID for website before creating record
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->website_uuid = str()->uuid()->toString();
        });
    }



    public function posts(){
        return $this->hasMany(WebsitePost::class,'website_id','id');
    }
}
