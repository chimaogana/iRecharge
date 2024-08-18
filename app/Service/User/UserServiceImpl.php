<?php
namespace App\Service\User;

use App\Http\Requests\User\UserRequest;
use App\Service\User\UserService;
use App\Models\User;

class UserServiceImpl implements UserService
{

    public function createUser(UserRequest $userRequest): UserRequest // Correct typehint

    {
        // dd($userRequest);
        $user = new User();
        $user->name = $userRequest->name;
        $user->email = $userRequest->email;
        $user->password = bcrypt($userRequest->password); // Remember to hash the password
        $user->save();
        return $userRequest;
    } 
    
}






?>