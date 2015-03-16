<?php namespace App\Sharp\Photo;

use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model {

    protected $table = "phototags";
    protected $fillable = ["text"];

    public function photos()
    {
        return $this->belongsToMany('App\Sharp\Photo\Photo');
    }

} 