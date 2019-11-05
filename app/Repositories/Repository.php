<?php

namespace App\Repositories;

use Feixin\Common\Models\Fd\Epaper;

abstract class Repository
{
    /**
     * @var \Eloquent|\DB
     */
    protected $model;

    /**
     * all
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * first
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * firstBy
     *
     * @param string $column
     * @param string $value
     * @param array  $columns
     *
     * @return mixed
     */
    public function firstBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * find
     *
     * @param string $id
     * @param array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * findBy
     *
     * @param string $column
     * @param string $value
     * @param array  $columns
     *
     * @return mixed
     */
    public function findBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * get
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * getBy
     *
     * @param string $column
     * @param string $value
     * @param array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBy($column, $value, $columns = ['*'])
    {
        return $this->model->where($column, $value)->get($columns);
    }

    /**
     * paginate
     *
     * @param null   $perPage
     * @param array  $columns
     * @param string $pageName
     * @param int    $page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * paginateBy
     *
     * @param string $column
     * @param string $value
     * @param null   $perPage
     * @param array  $columns
     * @param string $pageName
     * @param int    $page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateBy($column, $value, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->where($column, $value)->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * create
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * update
     *
     * @param string $id
     * @param array  $attributes
     * @param array  $options
     *
     * @return bool
     */
    public function update($id, array $attributes, array $options = [])
    {
        $instance = $this->model->findOrFail($id);

        return $instance->update($attributes, $options);
    }

    /**
     * updateBy
     *
     * @param string $column
     * @param string $value
     * @param array  $attributes
     * @param array  $options
     *
     * @return bool
     */
    public function updateBy($column, $value, array $attributes = [], array $options = [])
    {
        return $this->model->where($column, $value)->update($attributes, $options);
    }

    /**
     * destroy
     *
     * @param array $ids
     *
     * @return int
     *
     * @internal param $id
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * destroyBy
     *
     * @param string $column
     * @param string $value
     *
     * @return bool|null
     */
    public function destroyBy($column, $value)
    {
        return $this->model->where($column, $value)->delete();
    }

    public function setConnection($name)
    {
        $this->model->setConnection($name);

        return $this;
    }

    public function slave()
    {
//        dump($this->model->slave_connection);
        $this->setConnection('fd_slave');
//        $this->setConnection($this->model->slave_connection);

        return $this;
    }

    public function master()
    {
        $this->setConnection('fd_master');
//        $this->setConnection($this->model->connection);

        return $this;
    }
}
