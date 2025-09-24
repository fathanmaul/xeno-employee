<?php

namespace Database\Factories;

use App\Helpers\AttendanceHelper;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpPresence>
 */
class EmpPresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $check_in = Carbon::createFromTime(7, 30)->addMinutes($this->faker->numberBetween(0, 90));
        $check_out = Carbon::createFromTime(17, 0)->addMinutes($this->faker->numberBetween(-30, 30));

        return [
            'employee_id' => Employee::factory(),
            'check_in' => $check_in,
            'check_out' => $check_out,
            'late_in' => AttendanceHelper::calculateLateIn($check_in),
            'early_out' => AttendanceHelper::calculateEarlyOut($check_out),
        ];
    }
}
