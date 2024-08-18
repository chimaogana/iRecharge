<?php
namespace App\Service\User;

use App\Http\Requests\User\UserRequest;


interface UserService{



    public function createUser(UserRequest $userRequest): UserRequest;


}


















?>