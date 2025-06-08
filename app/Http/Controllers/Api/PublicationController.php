<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Publication\StorePublicationRequest;
use App\Http\Requests\Publication\UpdatePublicationRequest;
use App\Models\Publication;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PublicationController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All publications',
            'result' => Publication::all()
        ]);
    }

    /**
     * @param Publication $publication
     * @return JsonResponse
     */
    public function show(Publication $publication): JsonResponse
    {
        return Response::json([
            'message' => 'show publication',
            'result' => $publication
        ]);
    }

    /**
     * @param StorePublicationRequest $request
     * @return JsonResponse
     */
    public function store(StorePublicationRequest $request): JsonResponse
    {
        $publication = Auth::user()->publications()->create($request->validated());

        return Response::json([
            'message' => 'publication stored',
            'result' => $publication
        ], 201);
    }

    /**
     * @param Publication $publication
     * @param UpdatePublicationRequest $request
     * @return JsonResponse
     */
    public function update(Publication $publication, UpdatePublicationRequest $request): JsonResponse
    {
        $publication->update($request->validated());

        return Response::json([
            'message' => 'publication updated',
            'result' => $publication
        ], 202);
    }

    /**
     * @param Publication $publication
     * @return JsonResponse
     */
    public function delete(Publication $publication): JsonResponse
    {
        $publication->delete();

        return Response::json([
            'message' => 'publication deleted',
            'result' => $publication
        ]);
    }

    /**
     * @param Publication $publication
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function storeBook(Publication $publication, StoreBookRequest $request): JsonResponse
    {
        $book = $publication->books()->craete($request->validated());

        return Response::json([
            'message' => 'book stored',
            'result' => $book
        ], 201);
    }
}
