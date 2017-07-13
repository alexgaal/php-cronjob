<?php
class CronjobHandler
{
    protected $cronjobs = [];
	
	function __construct(array $cronjobs = [])
	{
	    $this->loadCronjobs($cronjobs);
	}
	
    protected function loadCronjobs(array $cronjobs = [])
    {
        if (0 === count($cronjobs)) {
            throw new \InvalidArgumentException('Cannot handle an empty cronjob array.');
        }
        
        foreach ($cronjobs as $cronjob) {
            $this->addCronjob($cronjob);
        }
    }
    
	public function addCronjob(Cronjob $cronjob)
    {
		if (null === $cronjob) {
			throw new \InvalidArgumentException("Cannot handle null as cronjob.");
		}
		
		if (!($cronjob instanceof Cronjob)) {
		    throw new \InvalidArgumentException('Cannot work with an object which is not an instance of Cronjob');
		}
		
		$this->cronjobs[] = $cronjob;
	}
	
	public function run()
	{
		foreach ($this->cronjobs as $cronjob) {
			if ($cronjob->now()) {
				$cronjob->run();
			}
		}
	}
}
