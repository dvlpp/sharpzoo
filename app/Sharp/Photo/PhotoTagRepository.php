<?php namespace App\Sharp\Photo;

class PhotoTagRepository {

    function formList()
    {
        $tags = PhotoTag::orderBy("text", "ASC")->get();
        $tab = [];
        foreach($tags as $t) $tab[$t->id] = $t->text;
        return $tab;
    }

} 