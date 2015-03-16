<?php namespace App\Sharp\Photo;

use Dvlpp\Sharp\Repositories\SharpModelWithFiles;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model implements SharpModelWithFiles {

    protected $fillable = ["animal_id", "animal_type"];

    function getSharpFilePathFor($attribute)
    {
        return public_path("files/photos/".$this->file);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Sharp\Photo\PhotoTag', 'photo_phototag', 'photo_id', 'phototag_id');
    }
} 