<?php
namespace ZfeggAdmin\V1\Rest\UserRoles;

use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class UserRolesResource extends AbstractResourceListener
{
    protected $table;
    protected $userId;

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
            'user_id'=> $this->getUserId(),
            'role_id'=> $data['role_id'],
        );
        $this->table->insert($insertData);
        return $data;
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
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $item = $this->table->delete(['user_id' => $this->getUserId(), 'role_id' => $id]);
        return ($item > 0);
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
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($params = array())
    {
        return $this->table->select(function (Select $select) {
            $select->columns([]);
            $select->join('admin_role', sprintf('%s.role_id=%s.role_id', 'admin_role', $this->table->getTable()));
            $select->where(['user_id' => $this->getUserId()]);
        });

//        $adapter = new DbSelect($select, $this->table->getAdapter());
//        return new $this->collectionClass($adapter);
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
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
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
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        if (!$this->userId) {
            $this->userId = (int)$this->getEvent()->getRouteParam('user_id');
        }

        return $this->userId;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
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


}
