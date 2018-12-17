# cloudlog-rigctl-interface
Connects Cloudlog to rigctld / hamlib via PHP.
This allows you to automatically log the used frequency and mode in Cloudlog's Live QSO menu. 

Change your parameters in config.php, 
```
// rigctl-specific configuration 
$rigctl_host = "127.0.0.1";
$rigctl_port = 4532;

// Cloudlog-specific parameters
$cloudlog_url = "https://log.tbspace.de";
$cloudlog_apikey = "p1fgZhGPbWMRaD4Iz5xm";

// displayed in Cloudlogs Live QSO menu
$radio_name = "FT-991a";

// minimum update interval
$interval = 1; 
``` 

If you're on Debian (or Ubuntu/similar), you can install everything that is required with: 
`apt install php-cli php-curl`

Start the software by running `php rigctlCloudlogInterface.php`.

If you want to run it in the background without an open terminal window, you can run `screen php rigctlCloudlogInterface.php`. (this won't work on Windows, sorry!) 

For more information on how-to setup hamlib/rigctld have a look over at the excellent guide written for pat: https://github.com/la5nta/pat/wiki/Rig-control
