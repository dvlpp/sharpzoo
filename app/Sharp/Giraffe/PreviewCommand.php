<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\Commands\SharpEntityCommand;

class PreviewCommand implements SharpEntityCommand {

    /**
     * @var Repository
     */
    private $repository;

    function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the entity command, and return
     * a file name (if command type is "download"),
     * an array of data for a view (case "view"),
     * or nothing.
     *
     * @param $instanceId
     * @return mixed
     */
    function execute($instanceId)
    {
        $giraffe = $this->repository->find($instanceId);
        return compact('giraffe');
    }
}