<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 26/10/2018
 * Time: 14:25
 */

namespace App\Services\Jobs;

use App\Repositories\Contracts\JobRepositoryInterface;


class JobService
{

    private $jobRepo;

    public function __construct(JobRepositoryInterface $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function execute() {
        return $this->jobRepo->all();
    }
}
