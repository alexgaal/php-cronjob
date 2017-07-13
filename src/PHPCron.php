<?php

namespace PHPCron;


class PHPCron
{
    private $cronjobs = [];

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

    /**
     * Starts PHPCron
     */
    public function start() : void
    {
        // NOT IMPLEMENTED YET
        // load crons (e.g. from Cache) and do some preparation for handle-function
    }

    /**
     * Iterates through all crons, check if execution is required and run task if necessary
     */
    private function handle() : void
    {
        // NOT IMPLEMENTED YET
    }
}