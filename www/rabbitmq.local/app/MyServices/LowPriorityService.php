<?php

namespace App\MyServices;

use PriorityServiceInterface;

class LowPriorityService extends PriorityServiceAbstract
{
    public function __construct()
    {
        $this->priority = 'low';
    }
}
