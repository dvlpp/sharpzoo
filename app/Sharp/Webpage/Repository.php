<?php namespace App\Sharp\Webpage;

use Dvlpp\Sharp\ListView\SharpEntitiesListParams;
use Dvlpp\Sharp\Repositories\SharpCmsRepository;

class Repository implements SharpCmsRepository {

    /**
     * Find an instance with the given id.
     *
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return Webpage::find($id);
    }

    /**
     * List all instances, with optional sorting and search.
     *
     * @param \Dvlpp\Sharp\ListView\SharpEntitiesListParams $params
     * @return mixed
     */
    function listAll(SharpEntitiesListParams $params)
    {
        // TODO: Implement listAll() method.
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
        // TODO: Implement paginate() method.
    }

    /**
     * Create a new instance for initial population of create form.
     *
     * @return mixed
     */
    function newInstance()
    {
        return new Webpage();
    }

    /**
     * Persists an instance.
     *
     * @param array $data
     * @return mixed
     */
    function create(Array $data)
    {
        // TODO: Implement create() method.
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
        // TODO: Implement update() method.
    }

    /**
     * Delete an instance.
     *
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}