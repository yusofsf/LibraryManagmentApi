<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Books',
            'result' => Book::all()
        ]);
    }

    /**
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return Response::json([
            'message' => 'show book',
            'result' => $book
        ]);
    }

    /**
     * @param Book $book
     * @return JsonResponse
     */
    public function delete(Book $book): JsonResponse
    {
        $book->delete();

        return Response::json([
            'message' => 'book deleted',
            'result' => Book::all()
        ]);
    }

    /**
     * @param Book $book
     * @param UpdateBookRequest $request
     * @return JsonResponse
     */
    public function update(Book $book, UpdateBookRequest $request): JsonResponse
    {
        $book->update($request->validated());

        return Response::json([
            'message' => 'book updated',
            'result' => $book
        ], 202);
    }
}
