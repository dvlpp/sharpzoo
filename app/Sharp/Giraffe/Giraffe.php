<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\Repositories\SharpModelWithFiles;
use Illuminate\Database\Eloquent\Model;

class Giraffe extends Model implements SharpModelWithFiles {

    protected $fillable = ["animal_card_id"];

    function photos()
    {
        return $this->morphMany('\App\Sharp\Photo\Photo', 'animal');
    }

    public function zookeeper()
    {
        return $this->belongsTo('\App\Sharp\Zookeeper\Zookeeper');
    }

    public function card()
    {
        return $this->belongsTo('\App\Sharp\Animal\AnimalCard', 'animal_card_id');
    }

    public function shows()
    {
        return $this->hasMany('\App\Sharp\Giraffe\Show\Show')->orderBy("order");
    }

    public function particularities()
    {
        return $this->belongsToMany('\App\Sharp\Particularity\Particularity', 'giraffes_particularities')->withTimestamps();
    }

    function getSharpFilePathFor($attribute)
    {
        return public_path("files/giraffes/".$this->picture);
    }
} 