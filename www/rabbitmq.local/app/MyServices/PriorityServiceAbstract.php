<?php

namespace App\MyServices;

abstract class PriorityServiceAbstract
{
    public $priority;

    public function getRandom()
    {
        $rand = mt_rand(3, 15);
        sleep($rand);
        return $rand;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}
