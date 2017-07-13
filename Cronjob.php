<?php
abstract class Cronjob
{
    protected $yearFormats = ['Y', 'y'];
    protected $monthFormats = ['m', 'n'];
    protected $dayFormats = ['d', 'j'];
    protected $hourFormats = ['H', 'G'];
    protected $minuteFormats = ['i'];

    protected $years;;
    protected $months;
    protected $days;
    
    protected $hours;
    protected $minutes;
    
    protected $specific;
    
    function __construct() {
        $this->years = ['*'];
        $this->months = ['*'];
        $this->days = ['*'];
        $this->hours = ['*'];
        $this->minutes = ['*'];
    }
    
    public function now()
    {
        $today = new DateTime('now');
        
        return
            ($this->year($today)
            && $this->month($today)
            && $this->day($today)
            && $this->hour($today)
            && $this->minute($today))
            || $this->specific($today);
    }
    
    protected function year($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->yearFormats as $yearFormat) {
            if ($this->isPresent($today->format($yearFormat), $this->years)) {
                return true;
            }
        }
        
        return false;
    }
    
    protected function month($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->monthFormats as $monthFormat) {
            if ($this->isPresent($today->format($monthFormat), $this->months)) {
                return true;
            }
        }
        
        return false;
    }

    protected function day($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->dayFormats as $dayFormat) {
            if ($this->isPresent($today->format($dayFormat), $this->days)) {
                return true;
            }
        }
        
        return false;
    }
    
    protected function hour($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->hourFormats as $hourFormat) {
            if ($this->isPresent($today->format($hourFormat), $this->hours)) {
                return true;
            }
        }
        
        return false;
    }
    
    protected function minute($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->minuteFormats as $minuteFormat) {
            if ($this->isPresent($today->format($minuteFormat), $this->minutes)) {
                return true;
            }
        }
        
        return false;
    }
    
    protected function specific($today = null)
    {
        if (null === $today) {
            $today = new DateTime('now');
        }
        
        foreach ($this->yearFormats as $yearFormat) {
            foreach ($this->monthFormats as $monthFormat) {
                foreach ($this->dayFormats as $dayFormat) {
                    foreach ($this->hourFormats as $hourFormat) {
                        foreach ($this->minuteFormats as $minuteFormat) {
                            if ($this->isPresent($today->format($yearFormat . '-' . $monthFormat . '-' . $dayFormat . ' ' . $hourFormat . ':' . $minuteFormat), $this->specific)) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
        
        return false;
    }
    
    protected function isPresent(string $dateString, array $dates) {
        foreach ($dates as $date) {
            if ('*' === $date) {
                return true;   
            }
            
            if ($date instanceof CronjobTime) {
                if ($date->isPresent($dateString)) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function year(int $interval)
    {
        $this->years = $this->interval(2017, 3000, $interval);
        
        return $this;
    }
    
    public function month(int $interval)
    {
        $this->months = $this->interval(1, 12, $interval);
        
        return $this;
    }
    
    public function days(int $interval)
    {
        $this->days = $this->interval(1, 31, $interval);
        
        return $this;
    }
    
    public function hours(int $interval)
    {
        $this->hours = $this->interval(0, 23, $interval);
        
        return $this;
    }
    
    public function minutes(int $interval)
    {
        $this->minutes = $this->interval(0, 59, $interval);
        
        return $this;
    }
    
    protected function interval(int $start, int $end, int $interval = 1): array
    {
        $intervalArray = [];
        
        for ($i = 1; $i <= $limit; $i + $interval) {
            $intervalArray[] = $i;
        }
        
        return $intervalArray;
    }
    
    public abstract function run(): boolean;
}
