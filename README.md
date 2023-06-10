# cloudlog-rigctl-interface
THIS FORK INCLUDES SOME MODIFICATIONS BY MICHAEL, GM5AUG, TO INCLUDE THE RIG POWER LEVEL IN THE CLOUDLOG SYNCHRONISATION. IT IS NOT PERFECT YET, BUT IT IS A PROGRESS.

ISSUES OUTSTANDING:
1) DOES NOT TAKE ANY EXTERNAL AMP INTO CONSIDERATION
2) THE .PHP FILE AUTOMATICALLY UPDATES CLOUDLOG WHENEVER YOU CHANGE FREQUENCY OR MODE, BUT NOT WHEN YOU CHANGE POWER. IF YOU CHANGE YOUR POWER LEVELS YOU NEED TO TWIDDLE THE DIAL FOR CLOUDLOG TO REGISTER THE CHANGE
3) I HAVE ONLY TESTED THIS ON MY ICOM IC-7100. I HAD TO MULTIPLY THE `RFPOWER` BY 100 AS THE RIG PRESENTS A POWER VALUE OF BETWEEN 0 AND 1. HOW THIS WORKS ON OTHER RIGS, I DON'T KNOW.

BEST WISHES
73 MICHAEL GM5AUG

Original README.md file 

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

Start the software by running `./rigctlCloudlogInterface.php`.
If you've downloaded the software as a .zip file instead of cloning it directly from the Git repository, you might have to make the file executable first. This is done by running
`chmod +x rigctlCloudlogInterface.php`.

If you want to run it in the background without an open terminal window, you can run `screen ./rigctlCloudlogInterface.php`. (this won't work on Windows, sorry!) 

If you prefer tmux, use `tmux new -s rigctlCloudlog ./rigctlCloudlogInterface.php`. 

For more information on how-to setup hamlib/rigctld have a look over at the excellent guide written for pat: https://github.com/la5nta/pat/wiki/Rig-control
