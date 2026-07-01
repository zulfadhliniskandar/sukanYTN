<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use App\Models\Sport;
use App\Models\Contingent;
use App\Models\MatchRecord;
use App\Models\MatchParticipant;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')]
        );

        $role = Role::firstOrCreate(['name' => 'PIC']);
        $user1->assignRole($role);

        $user2 = User::firstOrCreate(
            ['email' => 'player2@example.com'],
            ['name' => 'Player Two', 'password' => Hash::make('password')]
        );

        $venue = Venue::firstOrCreate(
            ['name' => 'Main Stadium'],
            [
                'latitude' => 3.1390,
                'longitude' => 101.6869,
                'location_link' => 'https://maps.google.com',
                'description' => 'National Sports Complex'
            ]
        );

        $sport = Sport::firstOrCreate(
            ['name' => 'Badminton'],
            [
                'venue_id' => $venue->id,
                'type' => 'individual'
            ]
        );

        $contingent1 = Contingent::firstOrCreate(['name' => 'Contingent A']);
        $contingent2 = Contingent::firstOrCreate(['name' => 'Contingent B']);

        $match = MatchRecord::firstOrCreate(
            ['title' => 'Badminton Men Singles - Finals'],
            [
                'sport_id' => $sport->id,
                'status' => 'ongoing',
                'start_time' => now()
            ]
        );

        MatchParticipant::firstOrCreate(
            ['match_id' => $match->id, 'user_id' => $user1->id],
            ['contingent_id' => $contingent1->id, 'score' => 21]
        );

        MatchParticipant::firstOrCreate(
            ['match_id' => $match->id, 'user_id' => $user2->id],
            ['contingent_id' => $contingent2->id, 'score' => 19]
        );
    }
}
