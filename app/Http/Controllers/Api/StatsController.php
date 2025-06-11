<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\StatsServiceInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class StatsController extends Controller
{

    /**
     * @var StatsServiceInterface
     */
    private StatsServiceInterface $statsService;

    /**
     * @param StatsServiceInterface $statsService
     */
    public function __construct(StatsServiceInterface $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * @return JsonResponse
     */
    public function lentBooks(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        $lentBooks = $this->statsService->lentBooks();

        return Response::json([
            'message' => 'lent books',
            'books' => $lentBooks
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function availableBooks(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        $availableBooks = $this->statsService->availableBooks();

        return Response::json([
            'message' => 'available books',
            'books' => $availableBooks
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function penalties(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        $penalties = $this->statsService->penalties();

        return Response::json([
            'message' => 'all penalties',
            'penalties' => $penalties
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function mostLentBooks(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        $mostLentBooks = $this->statsService->mostLentBooks();

        return Response::json([
            'message' => 'most lent books',
            'books' => $mostLentBooks
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function mostActiveUsers(): JsonResponse
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        $mostActiveUsers = $this->statsService->mostActiveUsers();

        return Response::json([
            'message' => 'most active users',
            'users' => $mostActiveUsers
        ]);
    }

    /**
     * @return mixed
     */
    public function statsToPDF(): mixed
    {
        Gate::allowIf(fn (User $user) => !$user->isMember());

        return $this->statsService->statsToPDF();
    }
}
