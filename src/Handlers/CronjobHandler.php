<?php

namespace PHPCron\Handlers;


use PHPCron\Cronjob;
use PHPCron\Interfaces\CronjobHandlerInterface;

class CronjobHandler implements CronjobHandlerInterface
{
    public function handle(Cronjob $cronjob)
    {
        if($this->needsExecution($cronjob)) {
            return $cronjob->run();
        }
    }

    private function needsExecution(Cronjob $cronjob) : bool
    {
        // TODO: implement if cron needs execution

        return true;
    }
}