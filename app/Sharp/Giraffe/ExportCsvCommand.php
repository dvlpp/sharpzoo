<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\Commands\SharpEntitiesListCommand;
use Dvlpp\Sharp\ListView\SharpEntitiesListParams;

class ExportCsvCommand implements SharpEntitiesListCommand {

    /**
     * @var Repository
     */
    private $repository;

    function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the entities list command, and return
     * a file name (if command type is "download"),
     * an array of data for a view (case "view"),
     * or nothing.
     *
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $entitiesListParams
     * @return mixed
     */
    function execute(SharpEntitiesListParams $entitiesListParams)
    {
        $query = Giraffe::with('zookeeper')
            ->where("zookeeper_id", $entitiesListParams->getCurrentSublistId());

        if($entitiesListParams->getSearch())
        {
            foreach($entitiesListParams->getSearchTerms() as $term)
            {
                $query->where(function ($query) use($term) {
                    $query->orWhere("name", "like", $term)
                        ->orWhere('desc', 'like', $term);
                });
            }
        }

        if($entitiesListParams->getSortedColumn())
        {
            $query->orderBy($entitiesListParams->getSortedColumn(), $entitiesListParams->getSortedDirection());
        }

        $giraffes =  $query->get();

        // Code omitted: generate a CSV file with $giraffes
        // ...

        return public_path("tmp/giraffes.csv");
    }
}