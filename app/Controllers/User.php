<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    public function show($username)
    {
        $userModel = new UserModel();          
        $user = $userModel->where('user', $username)->first();
        $this->respond(['user'=>$user]);
    }
}
