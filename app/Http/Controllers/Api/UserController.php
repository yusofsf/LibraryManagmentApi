<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => $user->isAdministrator());

        return Response::json([
            'message' => 'All Users',
            'result' => User::all()
        ]);
    }


    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        Gate::allowIf(fn (User $user) => $user->isAdministrator() || $user->isLibrarian());

        return Response::json([
            'message' => 'show user',
            'result' => $user
        ]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function delete(User $user): JsonResponse
    {
        Gate::allowIf(fn (User $user) => $user->isLibrarian());

        $user->delete();

        return Response::json([
            'message' => 'user deleted',
        ]);
    }

    /**
     * @param User $user
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function update(User $user, UserUpdateRequest $request): JsonResponse
    {
        Gate::allowIf(fn (User $user) => $user->isLibrarian());

        $user->update($request->validated());

        return Response::json([
            'message' => 'user updated',
            'result' => $user
        ], 202);
    }
}
