<?php

namespace App\Services;

use App\Enums\BookStatus;
use App\Interfaces\StatsServiceInterface;
use App\Models\Book;
use App\Models\penalty;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

readonly class StatsService implements StatsServiceInterface
{
    /**
     * @return Response
     */
    public function statsToPDF(): Response
    {
        $pdf = Pdf::setOption(['defaultFont' => 'Roboto'])->loadView('pdf.stats', [
            'lentBooks' => $this->lentBooks(),
            'availableBooks' => $this->availableBooks(),
            'penalties' => $this->penalties(),
            'mostLentBooks' => $this->mostLentBooks(),
            'mostActiveUsers' => $this->mostActiveUsers()])
            ->save(storage_path('pdfs/') . 'stats ' . Carbon::now()->format('Y-m-d H-i-s') . '.pdf');

        return $pdf->download('stats' . Carbon::now()->format('Y-m-d H-i-s') . '.pdf');
    }

    /**
     * @return Collection
     */
    public function lentBooks(): Collection
    {
        return Book::where('status', BookStatus::Lent)->select('title', 'author', 'release')->get();
    }

    /**
     * @return Collection
     */
    public function availableBooks(): Collection
    {
        return Book::join('reservations', 'books.id', '=', 'reservations.book_id')
            ->where('books.status', BookStatus::Available)
            ->whereNotNull('reservations.withdrawal_date')
            ->select('books.title', 'books.author', 'reservations.withdrawal_date')
            ->get();
    }

    /**
     * @return Collection
     */
    public function penalties(): Collection
    {
        return penalty::join('reservations', 'penalties.reservation_id', '=', 'reservations.id')
            ->join('books', 'reservations.book_id', '=', 'books.id')
            ->select('penalties.amount', 'penalties.days', 'books.title as book_title', 'books.author as book_author')
            ->get();
    }

    /**
     * @return Collection
     */
    public function mostLentBooks(): Collection
    {
        return Book::mostLentBooks()->get();
    }

    /**
     * @return Collection
     */
    public function mostActiveUsers(): Collection
    {
        return User::mostActiveUsers()->get();
    }
}
