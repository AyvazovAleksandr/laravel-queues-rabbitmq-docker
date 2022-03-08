<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Jobs\ProcessPriority;
use App\MyServices\PriorityServiceInterface;
use App\MyServices\HighestPriorityService;
use App\MyServices\LowPriorityService;
use App\MyServices\MiddlePriorityService;
use App\Models\RandomCounter;

class RabbitMqQueueController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $searchServices = [
            new HighestPriorityService(),
            new MiddlePriorityService(),
            new LowPriorityService()
        ];

        for ($i = 1; $i <= mt_rand(20, 300); $i++) {
            shuffle($searchServices);
            foreach ($searchServices as $service) {
                switch (get_class($service)) {
                    case "App\MyServices\HighestPriorityService":
                        dispatch(new ProcessPriority($service))->onConnection('rabbitmq')->onQueue('high');
                        break;
                    case "App\MyServices\MiddlePriorityService":
                        dispatch(new ProcessPriority($service))->onConnection('rabbitmq')->onQueue('middle');
                        break;
                    case "App\MyServices\LowPriorityService":
                        dispatch(new ProcessPriority($service))->onConnection('rabbitmq')->onQueue('low');
                        break;
                }
            }
        }
        return 'Queue built';
    }
}
