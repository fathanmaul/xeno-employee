<?php

namespace App\Helpers;

use App\Models\EmpPresence;
use App\Models\EmpSalary;
use Carbon\Carbon;

class SalaryHelper
{

  public static function calculatePenalty(int $employeeId): int
  {
    $presences = EmpPresence::where('employee_id', $employeeId)->get();

    $totalLate = 0;
    $totalEarly = 0;

    foreach ($presences as $p) {
      $lateMinutes = (int) round($p->late_in / 60);
      $earlyMinutes = (int) round($p->early_out / 60);

      if ($lateMinutes > 5) {
        $totalLate += $lateMinutes;
      }
      if ($earlyMinutes > 0) {
        $totalEarly += $earlyMinutes;
      }
    }

    return ($totalLate + $totalEarly) * 5000;
  }

  public static function calculateTotalSalary(int $basicSalary, int $bonus, int $bpjs, int $jp, int $loan, int $penalty): int
  {
    return ($basicSalary + $bonus) - ($bpjs + $jp + $loan + $penalty);
  }

  public static function recalcFromPresence(EmpPresence $presence)
  {
    $month = Carbon::parse($presence->check_in)->month;
    $year = Carbon::parse($presence->check_in)->year;

    $salary = EmpSalary::where('employee_id', $presence->employee_id)
      ->where('month', $month)
      ->where('year', $year)
      ->first();

    if ($salary) {
      $penalty = SalaryHelper::calculatePenalty($presence->employee_id);

      $salary->bonus = -$penalty;
      $salary->total_salary = static::calculateTotalSalary(
        $salary->basic_salary,
        $salary->bonus,
        $salary->bpjs,
        $salary->jp,
        $salary->loan,
        $penalty
      );

      $salary->save();
    }
  }

}