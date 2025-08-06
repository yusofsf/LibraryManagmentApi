<?php

namespace Database\Seeders;

use App\Constants\Constants;
use App\Enums\BookStatus;
use App\Enums\UserRole;
use App\Models\Book;
use App\Models\Publication;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $administrator = User::factory()->create([
            'user_name' => 'hassanh',
            'email' => 'hassan@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234567'),
            'remember_token' => Str::random(10),
            'role' => UserRole::ADMINISTRATOR
        ]);

        User::factory()->create(
            [
                'user_name' => 'mohammadm',
                'email' => 'mohammad@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'role' => UserRole::LIBRARIAN
            ]
        );

        Publication::factory(15)->has(Book::factory()->count(3))->create([
            'user_id' => $administrator->id,
        ]);

        $users = User::factory(10)->create();

        $books = Book::take(20)->get();

        foreach ($users as $user) {
            for ($i = 0; $i < 4; $i++) {
                $book = $books[rand(0, count($books) - 1)];
                if ($i % 2 === 0) {
                    Reservation::factory()->create([
                        'user_id' => $user->id,
                        'book_id' => $book->id
                    ]);

                    $book->update(['status' => BookStatus::LENT]);
                } else {
                    $reservation = Reservation::factory()->create([
                        'user_id' => $user->id,
                        'book_id' => $book->id,
                        'withdrawal_date' => now()->addDays(rand(10, 20))
                    ]);
                    $endDate = Carbon::parse($reservation->end_date);
                    $withdrawalDate = Carbon::parse($reservation->withdrawal_date);
                    $diffDays = round($endDate->diffInDays($withdrawalDate));

                    if ($diffDays > 0) {
                        $reservation->penalty()->create([
                            'days' => $diffDays,
                            'amount' => $diffDays * Constants::BASE_PRICE_PER_DAY_FOR_PENALTY
                        ]);
                    }

                    $book->update(['status' => BookStatus::AVAILABLE]);
                }
            }
        }
    }
}
