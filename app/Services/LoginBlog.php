<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/10/2018
 * Time: 16:04
 */

namespace App\Services;

use Validator;
use App\Helpers\ApiHelper;


class LoginBlog
{
    private $apiHelper;

    public function __construct(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;

    }

    public function execute($path, $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'bail|required'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->first();
            return ['errors' => $errors];
        }

        $data = $request->only('email', 'password');

        $result = $this->apiHelper->getTokenJson($path, $data);

        return $result;
    }
}
