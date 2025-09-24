<?php

namespace App\Helpers;

use Carbon\Carbon;

class AttendanceHelper
{
  public static function calculateLateIn(Carbon $check_in, Carbon $workStart = null): int
  {
    $workStart = $workStart ?? $check_in->copy()->setTime(8, 0, 0);

    if ($check_in->equalTo($workStart)) {
      return 0;
    }

    return $check_in->greaterThan($workStart)
      ? -1 * $workStart->diffInSeconds($check_in, false)
      : $workStart->diffInSeconds($check_in, false);
  }

  public static function calculateEarlyOut(Carbon $check_out, Carbon $workEnd = null): int
  {
    $workEnd = $workEnd ?? $check_out->copy()->setTime(17, 0, 0);

    return $check_out->lessThan($workEnd)
      ? -1 * $workEnd->diffInSeconds($check_out, false)
      : 0;
  }

}
