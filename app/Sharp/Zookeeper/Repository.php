<?php namespace App\Sharp\Zookeeper;

class Repository {

    function formList($askingInstance=null)
    {
        $zookeepers = Zookeeper::orderBy("name", "ASC")->get();
        $tab = [];
        foreach($zookeepers as $zk) $tab[$zk->id] = $zk->name;
        return $tab;
    }

} 