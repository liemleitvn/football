<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 26/10/2018
 * Time: 16:00
 */

require_once app_path(\App\Repositories\Eloquents\JobRepository::class);

if(isset($_GET)) {
    $job = new JobRepository();
}
