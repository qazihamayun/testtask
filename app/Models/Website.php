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
    protected $fillable     = ['name','url'];

    public function posts(){
        return $this->hasMany(WebsitePost::class,'website_id','id');
    }
}
