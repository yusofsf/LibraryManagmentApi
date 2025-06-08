<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publication;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function searchBooks(Request $request): JsonResponse
    {
        $query = Book::query();

        if ($request->query('title')) {
            $query->where('title', 'LIKE', '%' . $request->string('title') . '%');
        }
        if ($request->query('author')) {
            $query->where('author', 'LIKE', '%' . $request->string('author') . '%');
        }
        if ($request->query('status')) {
            $query->where('status', $request->string('status'));
        }

        $result = $query->get();

        return Response::json([
            'result' => $result ?? 'no result',
            'message' => 'search book result'
        ]);
    }

    public function searchPublications(Request $request): JsonResponse
    {
        $query = Publication::query();

        if ($request->query('name')) {
            $query->where('name', 'LIKE', '%' . $request->string('name') . '%');
        }
        if ($request->query('owner')) {
            $query->where('owner', 'LIKE', '%' . $request->string('owner') . '%');
        }
        if ($request->query('address')) {
            $query->where('address', 'LIKE', '%' . $request->string('address') . '%');
        }

        $result = $query->get();

        return Response::json([
            'result' => $result ?? 'no result',
            'message' => 'search publication result'
        ]);
    }

    public function searchReservations(Request $request): JsonResponse
    {
        $query = Reservation::query();

        if ($request->query('start_date')) {
            $query->where('start_date', 'LIKE', '%' . $request->string('start_date') . '%');
        }
        if ($request->query('end_date')) {
            $query->where('end_date', 'LIKE', '%' . $request->string('end_date') . '%');
        }

        $result = $query->get();

        return Response::json([
            'result' => $result ?? 'no result',
            'message' => 'search reservation result'
        ]);
    }
}
