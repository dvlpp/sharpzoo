<?php namespace App\Sharp\Particularity;

class Repository {

    function formList($askingInstance)
    {
        $particularities = Particularity::orderBy("name", "ASC")->get();
        $tab = [];
        foreach($particularities as $p) $tab[$p->id] = $p->name;
        return $tab;
    }

}