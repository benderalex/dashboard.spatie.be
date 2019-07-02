<?php

namespace App\Events\Jenkins;

use App\Events\DashboardEvent;

class JobsFetched extends DashboardEvent
{
    /** @var array */
    public $jobs;

    public function __construct(array $jobs)
    {
        $this->jobs = $jobs;
    }
}
