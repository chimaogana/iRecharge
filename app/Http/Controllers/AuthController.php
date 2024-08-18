<?php
namespace App\Http\Controllers;

use App\Service\User\UserService;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Http;

use JWTAuth; // Add this if using JWTAuth
 // Add this if using LoginRequest

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(compact('token'));
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(RegisterUser $request)
    {
        // dd($request->name);
        $validateRequest = $request->validated();
       
        $userDTO = UserRequest::fromArray($validateRequest);
        $createdUser = $this->userService->createUser($userDTO);
        // dd($createdUser);
        // $token = Auth::login($createdUser);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $createdUser,
           
        ]);
    }

      /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
      //  $response = Http::get('https://irecharge.com.ng/pwr_api_sandbox/v2/get_electric_disco.php?response_format=json');
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
  
        return response()->json(['message' => 'Successfully logged out']);
    }
}
