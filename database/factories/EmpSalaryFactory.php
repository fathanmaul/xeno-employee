<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpSalary>
 */
class EmpSalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $basic_salary = 2000000;
        $bonus = 0;
        $loan = 0;
        $bpjs = (int) ($basic_salary * 0.02);
        $jp = (int) ($basic_salary * 0.01);

        $total_salary = ($basic_salary + $bonus) - ($bpjs + $jp + $loan);
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'month' => $this->faker->month(),
            'year' => $this->faker->numberBetween(2018, 2025),
            'basic_salary' => $basic_salary,
            'bonus' => $bonus,
            'bpjs' => $bpjs,
            'jp' => $jp,
            'loan' => $loan,
            'total_salary' => $total_salary,
        ];
    }
}
