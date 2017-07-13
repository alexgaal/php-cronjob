# php-cronjob

## Usage

```php
    <?php 
    
    class MyTask extends Task
    {
        public function boot() : bool
        {
            // e.g. copy old files to tmp-dir
        }
        
        public function test() : bool
        {
            // e.g. test if old files are able to delete
        }
        
        public function run() : bool
        {
            // e.g. delete old files
        }
        
        public function clean() : bool
        {
            // e.g. remove copied old files from tmp-dir
        }
        
        public function reverse() : bool
        {
            // e.g. copy old files back from tmp-dir
        }
    }
    
    $mytask = new MyTask();
    $cronjob = new Cronjob(new DateInterval('P1D'), $mytask);
    
    $handler = new PHPCron;
    $handler->addCronjob($cronjob);
    
    $handler->start();
```

## To-Do
- implement Cronjob Handle
- add Cache (or something like that) to save Cronjobs
- give Cronjobs e.g. UUIDs to identify and only register them once (required if point 2 will be implemented) 
