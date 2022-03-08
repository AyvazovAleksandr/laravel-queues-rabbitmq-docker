<?php

namespace App\MyServices;

use PriorityServiceInterface;

class HighestPriorityService extends PriorityServiceAbstract
{


    public function __construct()
    {
        $this->priority = 'high';
    }
}
