<?php
class CronjobTime
{
    protected $start;
    protected $end;
    
    protected $times = [];
    
    function __construct(int $start, int $end, array $times = [])
    {
        if ($start < 0 || $end < 0) {
            throw new \InvalidArgumentException('Cannot handle a negative start or end value.');
        }
        
        if (0 === count($times)) {
            return;
        }
        
        foreach ($times as $time) {
            $this->add($time);
        }
    }
    
    public function add(int $time)
    {
        if ($time < $start) {
            throw new \InvalidArgumentException('Cannot handle an input, which is smaller than start (' . $this->start . ')');
        }
        
        if ($time > $end) {
            throw new \InvalidArgumentException('Cannot handle an input, which is greater than end (' . $this->end . ')');
        }
        
        $this->times[] = $time;
    }
    
    public function set(array $times)
    {
        $this->times = $times;
    }
}
