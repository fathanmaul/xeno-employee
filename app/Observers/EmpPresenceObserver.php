<?php

namespace App\Observers;

use App\Helpers\SalaryHelper;
use App\Models\EmpPresence;
use App\Models\EmpSalary;
use Carbon\Carbon;

class EmpPresenceObserver
{
    /**
     * Handle the EmpPresence "created" event.
     */
    public function created(EmpPresence $empPresence): void
    {
        //
    }

    /**
     * Handle the EmpPresence "updated" event.
     */
    public function updated(EmpPresence $empPresence): void
    {
        //
    }

    /**
     * Handle the EmpPresence "deleted" event.
     */
    public function deleted(EmpPresence $presence): void
    {
        SalaryHelper::recalcFromPresence($presence);
    }

    /**
     * Handle the EmpPresence "restored" event.
     */
    public function restored(EmpPresence $empPresence): void
    {
        //
    }

    /**
     * Handle the EmpPresence "force deleted" event.
     */
    public function forceDeleted(EmpPresence $empPresence): void
    {
        //
    }

    public function saved(EmpPresence $presence): void
    {
        SalaryHelper::recalcFromPresence($presence);
    }
}
