<?php
namespace ZfeggAdmin\V1\Rest\RoleResources;

use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbTableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class RoleResourcesResource extends AbstractResourceListener
{
    protected $table;

    protected $roleId;

    public function __construct(TableGateway $tableGateway)
    {
        $this->table = $tableGateway;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = $this->retrieveData($data);
        $insertData = array(
            'role_id'=> $this->getRoleId(),
            'resource' => $data['resource'],
            'methods'=> implode(',', $data['methods']),
        );
        $this->table->insert($insertData);

        return $data;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $this->table->delete(['id' => $id]);

        return true;
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->table->select(['role_id' => $this->getRoleId()]);

    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $data = $this->retrieveData($data);
        $updateData = array(
            'methods'=> implode(',', $data['methods']),
        );

        $this->table->update($updateData, ['id' => $id]);

        return $data;
    }

    /**
     * Retrieve data
     *
     * Retrieve data from composed input filter, if any; if none, cast the data
     * passed to the method to an array.
     *
     * @param mixed $data
     * @return array
     */
    protected function retrieveData($data)
    {
        $filter = $this->getInputFilter();

        if (null !== $filter) {
            return $filter->getValues();
        }

        return (array) $data;
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return (int)$this->getEvent()->getRouteParam('role_id');
    }

    public function fetchAllFull()
    {
        return $this->table->select();
    }
}
