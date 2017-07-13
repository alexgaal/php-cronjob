# php-cronjob

## Example
```php
<?php
class BackupCronjob extends Cronjob
{
    function __construct()
    {
        $this->minutes = new CronjobTime(0, 59, [0]);
    }
    
    public function run()
    {
        // do some database backup
    }
}
```

```php
<?php
$cronjobs = [
    new BackupCronjob()
];

$cronjobHandlerStaticFromArray = CronjobHandler::fromArray($cronjobs)->run();
$cronjobHandlerFromArray = new CronjobHandler($cronjobs)->run();

// 2017-07-13 08:24 -> $cronjob->now() would return false
```
