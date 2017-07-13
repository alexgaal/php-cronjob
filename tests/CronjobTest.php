<?php

class CronjobTest extends \PHPUnit\Framework\TestCase
{
    protected $task = null;
    protected $interval = null;
    protected $cron = null;

    public function setTask($boot = true, $test = true, $run = true, $clean = true, $reverse = true)
    {
        $this->task = new class($boot, $test, $run, $clean, $reverse) extends \PHPCron\Task {
            private $returns = [];

            public function __construct($boot, $test, $run, $clean, $reverse)
            {
                $this->returns = [
                    'boot' => $boot,
                    'test' => $test,
                    'run' => $run,
                    'clean' => $clean,
                    'reverse' => $reverse,
                ];
            }

            public  function boot(): bool
            {
                return $this->returns['boot'];
            }

            public  function test(): bool
            {
                return $this->returns['test'];
            }

            public  function run(): bool
            {
                return $this->returns['run'];
            }

            public  function clean(): bool
            {
                return $this->returns['clean'];
            }

            public  function reverse(): bool
            {
                return $this->returns['reverse'];
            }
        };
    }

    /**
     * @before
     */
    public function setCronjob($boot = true, $test = true, $run = true, $clean = true, $reverse = true) {
        $this->setTask($boot, $test, $run, $clean, $reverse);

        $this->interval = new DateInterval('P1DT1S');

        $this->cron = new \PHPCron\Cronjob($this->interval, $this->task);
    }

    public function testSetValuesViaConstructor() : void
    {
        $this->assertEquals($this->task, $this->cron->getTask());
        $this->assertEquals($this->interval, $this->cron->getInterval());
    }

    public function testSetStart() : void
    {
        $date = new DateTime('2017-07-13 12:08:22');

        $this->assertInstanceOf(DateTimeInterface::class, $this->cron->getStart());

        $this->cron->setStart($date);

        $this->assertEquals($date, $this->cron->getStart());
    }

    public function testSetEnd() : void
    {
        $date = new DateTime('2017-07-13 12:08:22');

        $this->assertEquals(null, $this->cron->getEnd());

        $this->cron->setEnd($date);

        $this->assertEquals($date, $this->cron->getEnd());
    }

    public function testRun() : void
    {
        $this->assertEquals(true, $this->cron->run());

        $this->setCronjob(true, false);
        $this->assertNull($this->cron->run());

        $this->setCronjob(true, true, true, true, true);
        $this->assertTrue($this->cron->run());

        $this->setCronjob(true, true, false, true, true);
        $this->assertFalse($this->cron->run());
    }

    /**
     * @expectedException \PHPCron\Exceptions\TaskBootException
     */
    public function testRunBoot() : void
    {
        $this->setCronjob(false);
        $this->cron->run();
    }

    /**
     * @expectedException \PHPCron\Exceptions\TaskCleanException
     */
    public function testRunClean() : void
    {
        $this->setCronjob(true, true, true, false);
        $this->cron->run();
    }

    /**
     * @expectedException \PHPCron\Exceptions\TaskReverseException
     */
    public function testRunReverse() : void
    {
        $this->setCronjob(true, true, false, true, false);
        $this->cron->run();
    }
}