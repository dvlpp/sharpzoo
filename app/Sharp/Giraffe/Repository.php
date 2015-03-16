<?php namespace App\Sharp\Giraffe;

use Dvlpp\Sharp\Lang\SharpLanguage;
use Dvlpp\Sharp\ListView\SharpEntitiesListParams;
use Dvlpp\Sharp\Repositories\SharpCmsRepository;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterTrait;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterWithUploads;
use Dvlpp\Sharp\Repositories\SharpHasActivateState;
use Dvlpp\Sharp\Repositories\SharpHasSublist;
use App\Sharp\Photo\Photo;
use App\Sharp\Zookeeper\Zookeeper;
use File;

class Repository implements SharpCmsRepository, SharpHasActivateState, SharpHasSublist, SharpEloquentRepositoryUpdaterWithUploads {

    use SharpEloquentRepositoryUpdaterTrait;

    protected $currentZookeeperId;

    protected $lang;

    function __construct(SharpLanguage $sharpLang)
    {
        $this->lang = $sharpLang->current();
    }

    /**
     * Find an instance with the given id.
     *
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return Giraffe::findOrFail($id);
    }

    /**
     * List all instances, with optional sorting and search.
     *
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $params
     * @return mixed
     */
    function listAll(SharpEntitiesListParams $params)
    {
        $giraffes = Giraffe::with('zookeeper');

        if($params->getSortedColumn())
        {
            $giraffes->orderBy($params->getSortedColumn(), $params->getSortedDirection());
        }

        return $giraffes->get();
    }

    /**
     * Paginate instances.
     *
     * @param $count
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $params
     * @return mixed
     */
    function paginate($count, SharpEntitiesListParams $params)
    {
        $giraffes = Giraffe::with('zookeeper')
            ->where("lang", $this->lang)
            ->where("zookeeper_id", $this->getCurrentSublistId());

        if($params->getSearch())
        {
            if($params->isAdvancedSearch())
            {
                foreach($params->getSearch() as $field => $value)
                {
                    switch($field)
                    {
                        case "age":
                            $ageComp = $params->getAdvancedSearchValue("age_comp");
                            $giraffes->where("age", $ageComp, $value);
                            break;

                        case "name":
                            foreach(explode_search_words($value) as $term)
                            {
                                $giraffes->where("name", "like", $term);
                            }
                            break;

                        case "particularities":
                            foreach($value as $v)
                            {
                                $giraffes->whereExists(function($query) use ($v)
                                {
                                    $query->select('giraffe_id')
                                        ->from('giraffes_particularities')
                                        ->whereRaw('giraffes_particularities.giraffe_id = giraffes.id '
                                            .'AND giraffes_particularities.particularity_id='.$v);
                                });
                            }
                    }
                }
            }

            else
            {
                // Quicksearch
                foreach(explode_search_words($params->getSearch()) as $term)
                {
                    $giraffes->where(function ($query) use($term) {
                        $query->orWhere("name", "like", $term)
                            ->orWhere('desc', 'like', $term);
                    });
                }
            }
        }

        if($params->getSortedColumn())
        {
            $giraffes->orderBy($params->getSortedColumn(), $params->getSortedDirection());
        }

        return $giraffes->paginate($count);
    }

    /**
     * Create a new instance for initial population of create form.
     *
     * @return mixed
     */
    function newInstance()
    {
        $g = new Giraffe();
        $g->lang = $this->lang;
        $g->alive = false;
        return $g;
    }

    /**
     * Persists an instance.
     *
     * @param array $data
     * @return mixed
     */
    function create(Array $data)
    {
        //dd($data);
        $this->update(null, $data);
    }

    /**
     * Update an instance.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    function update($id, Array $data)
    {
        $giraffe = $id ? $this->find($id) : $this->newInstance();

        $this->updateEntity("africa", "giraffe", $giraffe, $data);
    }

    /**
     * Delete an instance.
     *
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    function activate($id)
    {
        $giraffe = $this->find($id);
        $giraffe->alive = true;
        $giraffe->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    function deactivate($id)
    {
        $giraffe = $this->find($id);
        $giraffe->alive = false;
        $giraffe->save();
    }

    function initCurrentSublistId($sublist)
    {
        $this->currentZookeeperId = $sublist;
    }

    function getCurrentSublistId()
    {
        if(!$this->currentZookeeperId)
        {
            $this->currentZookeeperId = Zookeeper::orderBy("name", "asc")->first()->id;
        }

        return $this->currentZookeeperId;
    }

    function getSublists()
    {
        $zookeepers = Zookeeper::orderBy("name", "ASC")->get();
        $tab = [];
        foreach($zookeepers as $zk) $tab[$zk->id] = $zk->name;

        return $tab;
    }

    function createPhotosListItem($instance)
    {
        return new Photo([
            "animal_id" => $instance->id,
            "animal_type" => 'Quincy\Sharp\Giraffe\Giraffe'
        ]);
    }

    /**
     * Must update the upload in the database, depending on implementation.
     *
     * @param $instance
     * @param $attr
     * @param $file
     * @return mixed
     */
    function updateFileUpload($instance, $attr, $file)
    {
        $destPath = $instance instanceof Photo
            ? public_path("files/photos")
            : public_path("files/giraffes");

        if(starts_with($file, ":DUPL:"))
        {
            $file = substr($file, strlen(":DUPL:"));
            $fileName = $this->moveFile($file, $destPath, true);
        }
        else
        {
            $file = public_path("tmp/$file");
            $fileName = $this->moveFile($file, $destPath);
        }

        $instance->$attr = $fileName;
    }

    /**
     * Delete the upload on the database, depending on implementation.
     *
     * @param $instance
     * @param $attr
     * @return mixed
     */
    function deleteFileUpload($instance, $attr)
    {
        $instance->$attr = null;
    }

    private function moveFile($file, $dest, $copy=false)
    {
        $fileName = basename($file);
        $srcFile = $file;

        if(File::exists($srcFile))
        {
            if(!File::isDirectory($dest))
            {
                File::makeDirectory($dest, 0777, true);
            }

            if($copy)
            {
                File::copy($srcFile, "$dest/$fileName");
            }
            else
            {
                File::move($srcFile, "$dest/$fileName");
            }

            return $fileName;
        }

        return null;
    }
}