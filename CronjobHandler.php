<?php
class CronjobHandler
{
    protected $cronjobs = [];
	
	public static function fromArray(array $cronjobs) {
		return new CronjobHandler($cronjobs);	
	}
	
	public static function fromDirectory(string $directory) {
		//return new CronjobHandler($directory);	
	}
	
	function __construct(array $cronjobs = [])
	{
	    $this->loadCronjobs($cronjobs);
		
		return $this;
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
		
		return $this;
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
