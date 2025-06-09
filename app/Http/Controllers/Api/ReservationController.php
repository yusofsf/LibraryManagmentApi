<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constants;
use App\Enums\BookStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Requests\Reservation\WithdrawalReservationRequest;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class ReservationController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        Gate::allowIf(Auth::user()->isLibrarian() || Auth::user()->isAdministrator());
        return Response::json([
            'message' => 'All Reservations',
            'result' => Reservation::all()
        ]);
    }

    /**
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function show(Reservation $reservation): JsonResponse
    {
        Gate::allowIf(Auth::user()->isLibrarian() || Auth::user()->isAdministrator());

        return Response::json([
            'message' => 'show reservation',
            'result' => $reservation
        ]);
    }

    /**
     * @param Book $book
     * @param StoreReservationRequest $request
     * @return JsonResponse
     */
    public function store(Book $book, StoreReservationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($book->status === BookStatus::Lent) {
            return Response::json([
                'message' => 'book not available',
            ]);
        }

        $book->update([
            'status' => BookStatus::Lent
        ]);

        $reservation = Auth::user()->reservations()->create([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'book_id' => $book->id,
        ]);

        return Response::json([
            'message' => 'reservation stored',
            'result' => $reservation
        ], 201);
    }

    /**
     * @param Reservation $reservation
     * @param Book $book
     * @param UpdateReservationRequest $request
     * @return JsonResponse
     */
    public function update(Reservation $reservation, Book $book, UpdateReservationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $reservation->book->update([
            'status' => BookStatus::Available
        ]);

        $reservation->update([
            'end_date' => $validated['end_date'],
            'book_id' => $book->id,
        ]);

        $book->update([
            'status' => BookStatus::Lent
        ]);

        return Response::json([
            'message' => 'reservation updated',
            'result' => $reservation
        ], 202);
    }

    /**
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function delete(Reservation $reservation): JsonResponse
    {
        $reservation->delete();

        return Response::json([
            'message' => 'reservation deleted',
            'result' => $reservation
        ]);
    }

    public function withdrawal(Reservation $reservation, Book $book, WithdrawalReservationRequest $request)
    {
        $validated = $request->validated();

        $reservation->update([
            'withdrawal_date' => $validated['withdrawal_date']
        ]);

        $book->update([
            'status' => BookStatus::Available
        ]);

        $endDate = Carbon::parse($reservation->end_date);
        $withdrawalDate = Carbon::parse($reservation->withdrawal_date);
        $diffDays = round($endDate->diffInDays($withdrawalDate));

        if ($diffDays > 0) {
            $reservation->penalty()->create([
                'days' => $diffDays,
                'amount' => $diffDays * Constants::BASE_PRICE_PER_DAY_FOR_PENALTY
            ]);

            return Response::json([
                'message' => 'reservation withdrawal',
                'result' => $reservation->with('penalty')->get()
            ], 202);
        }

        return Response::json([
            'message' => 'reservation withdrawal',
            'result' => $reservation
        ], 202);
    }
}
