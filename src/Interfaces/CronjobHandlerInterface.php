<?php

namespace PHPCron\Interfaces;


use PHPCron\Cronjob;

interface CronjobHandlerInterface
{
    public function handle(Cronjob $cronjob);
}