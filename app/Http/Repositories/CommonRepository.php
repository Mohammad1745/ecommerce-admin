<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 4:17 PM
 */

namespace App\Http\Repositories;


class CommonRepository
{
    public $model;

    /**
     * CommonRepository constructor.
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($where, $data)
    {
        return $this->model->updateOrCreate($where, $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     */
    public function update($where, $data)
    {
        return $this->model->where($where)->update($data);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function deleteWhere($where)
    {
        return $this->model->where($where)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @param string[] $orderBy
     * @return mixed
     */
    public function getAll($orderBy = ['id', 'ASC'])
    {
        return $this->model->orderBy($orderBy[0], $orderBy[1])->get();
    }

    /**
     * @return mixed
     */
    public function getAllQuery()
    {
        return $this->model->query();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function getWhereQuery($where)
    {
        return $this->model->where($where);
    }

    /**
     * @param array $where
     * @param string[] $orderBy
     * @return mixed
     */
    public function whereFirst($where = [], $orderBy = ['id', 'ASC'])
    {
        return $this->model->where($where)->orderBy($orderBy[0], $orderBy[1])->first();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getWhere($where = [])
    {
        return $this->model->where($where)->get();
    }

    /**
     * @param array $whereIn
     * @return mixed
     */
    public function getWhereIn($whereIn = [])
    {
        return $this->model->whereIn($whereIn)->get();
    }

    /**
     * @param array $whereNotIn
     * @return mixed
     */
    public function getWhereNotIn($whereNotIn = [])
    {
        return $this->model->whereNotIn($whereNotIn[0], $whereNotIn[1])->get();
    }

    /**
     * @param $where
     * @param $pluck
     * @return mixed
     */
    public function pluckWhere($where, $pluck)
    {
        return $this->model->where($where)->pluck($pluck);
    }

    /**
     * @param $select
     * @param $where
     * @param int $paginate
     * @return mixed
     */
    public function selectWhere($select, $where, $paginate = 0)
    {
        if ($paginate === 0) {
            return $this->model->select($select)->where($where)->get();
        }

        return $this->model->select($select)->where($where)->paginate($paginate);
    }
}
