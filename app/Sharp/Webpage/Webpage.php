<?php namespace App\Sharp\Webpage;

use Dvlpp\Sharp\Repositories\SharpModelWithFiles;
use Illuminate\Database\Eloquent\Model;

class Webpage extends Model implements SharpModelWithFiles {

    protected $fillable = ["owner_id", "owner_type"];

    public function owner()
    {
        return $this->morphTo();
    }

    function blocks()
    {
        return $this->hasMany('\App\Sharp\Webpage\Webblock\Webblock')->orderBy('order');
    }

    function getSharpFilePathFor($attribute)
    {
        return public_path("files/webpages/".$this->picture);
    }

}