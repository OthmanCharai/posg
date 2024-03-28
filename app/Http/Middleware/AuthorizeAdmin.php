<?php

namespace App\Http\Middleware;

use App\src\Domain\Permissions\AdminPermissionService;
use App\src\Domain\Permissions\Exceptions\UnauthorizedException;
use App\src\Models\User\User;
use App\src\Services\User\UserServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthorizeAdmin
{
    public function __construct(
        private readonly AdminPermissionService $permissionService,
        private readonly UserServiceInterface $adminService
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     *
     */
    public function handle(Request $request, Closure $next, int ...$permissions)
    {
        $admin = $this->adminService->find(auth()->user()->id);

        if (!$admin instanceof User) {
            return $next($request);
        }

        try {
            $this->permissionService->authorize($admin, ...$permissions);
        } catch (UnauthorizedException $e) {
            abort(HttpResponse::HTTP_UNAUTHORIZED, "you don't have access to this page");
        }

        return $next($request);
    }
}
