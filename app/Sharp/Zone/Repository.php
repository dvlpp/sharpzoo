<?php namespace App\Sharp\Zone;

use Dvlpp\Sharp\ListView\SharpEntitiesListParams;
use Dvlpp\Sharp\Repositories\SharpCmsRepository;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterTrait;
use Dvlpp\Sharp\Repositories\SharpEloquentRepositoryUpdaterWithUploads;
use Dvlpp\Sharp\Repositories\SharpIsReorderable;
use App\Sharp\Photo\Photo;
use App\Sharp\Webpage\Webpage;

class Repository implements SharpCmsRepository, SharpIsReorderable, SharpEloquentRepositoryUpdaterWithUploads {

    use SharpEloquentRepositoryUpdaterTrait;

    function find($id)
    {
        return Zone::findOrFail($id);
    }

    function listAll(SharpEntitiesListParams $params)
    {
        return Zone::orderBy("order", "asc")->get();
    }

    function paginate($count, SharpEntitiesListParams $params)
    {
    }

    function newInstance()
    {
        $zone = new Zone();
        $zone->order = 0;
        return $zone;
    }

    function reorder(Array $entitiesIds)
    {
        $k = 1;
        foreach($entitiesIds as $id)
        {
            Zone::where("id", $id)->update(["order"=>$k++]);
        }
    }

    function create(Array $data)
    {
        return $this->update(null, $data);
    }

    function update($id, Array $data)
    {
        $zone = $id ? Zone::find($id) : $this->newInstance();
        return $this->updateEntity("africa", "zone", $zone, $data);
    }

    function delete($id)
    {
    }

    function createWebpageEmbed($instance)
    {
       return new Webpage([
           "owner_id" => $instance->id,
           "owner_type" => 'Quincy\Sharp\Zone\Zone'
       ]);
    }

    function createPhotosListItem($instance)
    {
        return new Photo([
            "animal_id" => $instance->id,
            "animal_type" => 'Quincy\Sharp\Webpage\Webpage'
        ]);
    }

    /**
     * Must return the folder where to put the designated upload.
     * Folder will be created if needed.
     *
     * @param $instance
     * @param $attr
     * @return mixed
     */
    function getFileUploadPath($instance, $attr)
    {
        if($instance instanceof Webpage)
        {
            return public_path("files/webpages");
        }
        elseif($instance instanceof Photo)
        {
            return public_path("files/photos");
        }
        return null;
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
        $instance->$attr = $file;
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
}