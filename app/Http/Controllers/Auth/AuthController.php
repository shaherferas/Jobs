<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"User"},
     *     summary="login for an exisiting user",
     *     operationId="login",
     *     @OA\Response(
     *         response=200,
     *         description="successful login",
     *     ),
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="The email of the user",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="The password of the user",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *       {"sanctum": {}},
     *     }
     * )
     */
    public function login(UserLoginRequest $request)
    {

        $result = $this->userService->loginUser($request->validated());

        if (isset($result['error'])) {
            return response()->json($result, Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($result,Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"User"},
     *     summary="logout for an exisiting user",
     *     operationId="logout",
     *     @OA\Response(
     *         response=200,
     *         description="successful login",
     *     ),
     *     security={
     *       {"sanctum": {}},
     *     }
     * )
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json('logged out',Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"User"},
     *     summary="register for an new user",
     *     operationId="register",
     *     @OA\Response(
     *         response=200,
     *         description="successful login",
     *     ),
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="The email of the user",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     description="The name of the user",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="The password of the user",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     description="The password conformation of the user",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     security={
     *       {"sanctum": {}},
     *     }
     * )
     */
    public function register(UserRegisterRequest $request)
    {
        $result = $this->userService->registerUser($request->validated());
        return response()->json($result, Response::HTTP_OK);
    }
}
