# cloudlog-rigctl-interface
Connects Cloudlog to rigctld / hamlib via PHP

Change your parameters in config.php, 
```
// rigctl-specific configuration 
$rigctl_host = "127.0.0.1";
$rigctl_port = 4532;

// Cloudlog-specific parameters
$cloudlog_url = "https://log.tbspace.de";

// displayed in Cloudlogs Live QSO menu
$radio_name = "FT-991a";

// minimum update interval
$interval = 1; 
``` 

Needs php-curl. 
