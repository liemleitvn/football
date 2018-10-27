<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 26/10/2018
 * Time: 14:16
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\JobRepositoryInterface;
use App\Models\Jobs;


class JobRepository extends EloquentAbstract implements JobRepositoryInterface
{

    protected $model;

    public function __construct(Jobs $job)
    {
        $this->model = $job;
    }
}
