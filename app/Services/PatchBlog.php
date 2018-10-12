<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 12/10/2018
 * Time: 09:48
 */

namespace App\Services;

use Validator;
use App\Helpers\ApiHelper;


class PatchBlog
{

    private $apiHepler;

    public function __construct(ApiHelper $apiHelper)
    {
        $this->apiHepler = $apiHelper;
    }

    public function execute($request, $path, $id = "", $params = "") {

        $validator = Validator::make($request->all(),[
            'title'=>'bail|required|max:100',
            'category'=>'bail|required|numeric',
            'content'=>'bail|required'
        ]);

        //validate error
        if ($validator->fails()) {
            $errors = $validator->errors()->first();

            return ['errors'=>$errors];
        }

        $data = $request->only('title', 'category', 'content');

        $result = $this->apiHepler->patchJson($path,$data,$params);

        if ($result !== 204) {
            return ['errors'=>$result];
        }

        return ['success'=>'update successful'];
    }

}
