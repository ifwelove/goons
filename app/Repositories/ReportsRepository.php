<?php

namespace App\Repositories;

use Feixin\Common\Models\Fd\Epaper;

class ReportsRepository extends Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct(Epaper $model)
    {
        $this->model = $model;
    }

    public function overview()
    {
        return $this->model->select('DisplayName')->find(3);
    }
}
