<?php

class PHPCronTest extends \PHPUnit\Framework\TestCase
{
    public function testSetHandlers()
    {
        $phpcron = new \PHPCron\PHPCron();

        $this->assertInstanceOf(\PHPCron\Handlers\ResultHandler::class, $phpcron->getResultHandler());
        $this->assertInstanceOf(\PHPCron\Handlers\CronjobHandler::class, $phpcron->getCronjobHandler());
    }
}