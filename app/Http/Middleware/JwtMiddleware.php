<?php

namespace App\Http\Middleware;

use App\src\Entities\UserLocator;
use App\src\Models\User\User;
use Closure;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function __construct(private readonly Repository $repository, private readonly UserLocator $userLocator)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie($this->repository->get('globals.auth_cookie_name'))) {
            $token = $request->cookie($this->repository->get('globals.auth_cookie_name'));
            $request->headers->add(
                [
                    'Authorization' => 'Bearer ' . $token,
                ]
            );
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user instanceof User) {
                $this->userLocator->setUser($user);
            }
        } catch (TokenInvalidException|Exception $e) {
            return response()->json(['status' => 'unauthorized'])->setStatusCode(419);
        }

        return $next($request);
    }
}
