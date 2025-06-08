<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penalty\UpdatePenaltyRequest;
use App\Models\penalty;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PenaltyController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Penalties',
            'result' => penalty::all()
        ]);
    }

    /**
     * @param penalty $penalty
     * @return JsonResponse
     */
    public function show(Penalty $penalty): JsonResponse
    {
        return Response::json([
            'message' => 'show penalty',
            'result' => $penalty
        ]);
    }

    /**
     * @param penalty $penalty
     * @return JsonResponse
     */
    public function delete(Penalty $penalty): JsonResponse
    {
        $penalty->delete();

        return Response::json([
            'message' => 'penalty deleted',
        ]);
    }

    /**
     * @param penalty $penalty
     * @param UpdatePenaltyRequest $request
     * @return JsonResponse
     */
    public function update(Penalty $penalty, UpdatePenaltyRequest $request): JsonResponse
    {
        $penalty->update($request->validated());

        return Response::json([
            'message' => 'penalty updated',
            'result' => $penalty
        ], 202);
    }
}
