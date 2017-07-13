<?php

namespace PHPCron;


use PHPCron\Handlers\CronjobHandler;
use PHPCron\Handlers\ResultHandler;
use PHPCron\Interfaces\CronjobHandlerInterface;
use PHPCron\Interfaces\CronjobResultInterface;

class PHPCron
{
    private $cronjobs = [];

    private $resultHandler = null;

    private $cronjobHandler = null;

    public function __construct()
    {
        $this->setResultHandler(new ResultHandler);
        $this->setCronjobHandler(new CronjobHandler);
    }

    public function addCronjob(Cronjob $cronjob) : PHPCron
    {
        $this->cronjobs[] = $cronjob;

        return $this;
    }

    public function addCronjobs(array $cronjobs) : PHPCron
    {
        foreach($cronjobs as $cronjob) {
            $this->addCronjob($cronjob);
        }

        return $this;
    }

    public function setResultHandler(CronjobResultInterface $handler) : PHPCron
    {
        $this->resultHandler = $handler;

        return $this;
    }

    public function getResultHandler() : CronjobResultInterface
    {
        return $this->resultHandler;
    }

    public function setCronjobHandler(CronjobHandlerInterface $handler) : PHPCron
    {
        $this->cronjobHandler = $handler;

        return $this;
    }

    public function getCronjobHandler() : CronjobHandlerInterface
    {
        return $this->cronjobHandler;
    }

    /**
     * Starts PHPCron
     */
    public function start() : void
    {
        // NOT IMPLEMENTED YET
        // TODO: load crons (e.g. from Cache) and do some preparation for handle-function

        $this->handle();
    }

    /**
     * Iterates through all crons, check if execution is required and run task if necessary
     */
    private function handle() : void
    {
        foreach ($this->cronjobs as $cronjob) {
            $result = $this->getCronjobHandler()->handle($cronjob);

            $this->getResultHandler()->handle($result);
        }
    }
}