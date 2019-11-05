<?php

namespace App\Services;

use App\Repositories\ReportsRepository;

class ReportService
{
    private $reportsRepository;

    public function __construct(ReportsRepository $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
    }

    public function overview()
    {
        $result = $this->reportsRepository->overview();
        dump($result);
        $result = $this->reportsRepository->fdSlave()->overview()->toArray();
        dump($result);
        $result = $this->reportsRepository->master()->overview()->toArray();
        dump($result);

        $result = $this->reportsRepository->setConnection('fd_slave')->overview()->toArray();
        dump($result);
        $result = $this->reportsRepository->setConnection('fd_master')->overview()->toArray();
        dump($result);
dd(1);
        return $result;
    }
}
