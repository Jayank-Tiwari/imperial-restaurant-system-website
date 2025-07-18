<?php

namespace Database\Factories;

use App\Models\Bookings;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingsFactory extends Factory
{
    protected $model = Bookings::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // or change to any existing user ID
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->numerify('9#########'),
            'reservation_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'reservation_time' => $this->faker->randomElement([
                '17:00', '17:30', '18:00', '18:30',
                '19:00', '19:30', '20:00', '20:30', '21:00'
            ]),
            'guests' => $this->faker->numberBetween(1, 8),
            'status' => $this->faker->randomElement([1, 2]), // 1 = confirmed, 2 = cancelled
            'occasion' => $this->faker->randomElement([
                'birthday', 'anniversary', 'business', 'celebration', 'date', 'other', null
            ]),
            'special_requests' => $this->faker->sentence,
        ];
    }
}
