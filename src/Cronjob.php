<?php

namespace PHPCron;

use PHPCron\Exceptions\TaskBootException;
use PHPCron\Exceptions\TaskCleanException;
use PHPCron\Exceptions\TaskReverseException;

class Cronjob
{
    private $task = null;

    private $interval = null;

    private $start = null;

    private $end = null;

    public function __construct(\DateInterval $interval, Task $task)
    {
        $this->interval = $interval;
        $this->task = $task;

        $this->start = new \DateTime('now');
    }

    public function getTask() : Task
    {
        return $this->task;
    }

    public function getInterval() : \DateInterval
    {
        return $this->interval;
    }

    public function setStart(\DateTimeInterface $start) : Cronjob
    {
        $this->start = $start;

        return $this;
    }

    public function getStart() : \DateTimeInterface
    {
        return $this->start;
    }

    public function setEnd(\DateTimeInterface $end) : Cronjob
    {
        $this->end = $end;

        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function run()
    {
        $task = $this->getTask();

        if(!$task->test()) { return null; }
        if(!$task->boot()) { throw new TaskBootException(); }
        if(!$task->run()) {
            if(!$task->reverse()) { throw new TaskReverseException(); }
            return false;
        } else {
            if(!$task->clean()) { throw new TaskCleanException(); }
            return true;
        }
    }
}