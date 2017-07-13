<?php

namespace PHPCron\Interfaces;


interface CronjobResultInterface
{
    /**
     * Handles the result and e.g. writes it to a file.
     *
     * @param mixed $result true on run-success, false on run-failure, null on test-failure
     * @return mixed
     */
    public function handle($result);
}