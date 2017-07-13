<?php

namespace PHPCron;


abstract class Task
{
    /**
     * Boot the Task
     *
     * Runs before the Task, helpful for e.g. saving settings for reverse-function
     *
     * @return bool true on success, false on failure
     */
    public abstract function boot() : bool;

    /**
     * Test the Task
     *
     * Checks if your Task will succeed or fail, no changes are made
     *
     * @return bool
     */
    public abstract function test() : bool;

    /**
     * Run the Task
     *
     * Executes the Task, changes are made
     *
     * @return bool true on success, false on failure
     */
    public abstract function run() : bool;

    /**
     * Clean the Task
     *
     * Runs after the Task succeeded, helpful for e.g. cleaning saved boot-data
     *
     */
    public abstract function clean() : bool;

    /**
     * Reverse the Task
     *
     * Runs after the Task failed, helpful for e.g. reverse saved boot-data
     *
     * @return bool
     */
    public abstract function reverse() : bool;
}