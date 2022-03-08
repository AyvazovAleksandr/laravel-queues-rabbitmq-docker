<?php

namespace App\MyServices;

use PriorityServiceInterface;

class MiddlePriorityService extends PriorityServiceAbstract
{
    public function __construct()
    {
        $this->priority = 'middle';
    }
}
