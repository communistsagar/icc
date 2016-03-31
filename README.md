OpenCric
========
The open source live cricket project
-------------------------------------
OpenCric is an open source php script that allows you to create a full featured live cricket score website without any effort. 
Please keep in mind that OpenCric only features live cricket score and ball by ball updates. 
Fixtures, Results are not available right now, due to ESPN's API limitation. However, I'll try to add 'em in upcoming version(s).  

## Please note: 

* OpenCric is powered by ESPNCricinfo API and it may have few limitations or copyright issues
* OpenCric is released under The MIT License ( https://opensource.org/licenses/MIT ) 
* Former version of OpenCric is deprecated and will not be updated any more.

## How to Install
Extract the ZIP archive on your hosting and open "**app-inc/app-config.php**" with a text editor and put your details there and save off course!
```
$_SITE=array(
	'name' => 'OpenCric', // Your site name
	'tagline' => 'Live Cricket Score & Fixtures!', // tagline
	'url' => 'http://localhost/opencric', // full path to site
	'desc' => 'OpenCric allows you to create a full featured live cricket score mobile site for free!', // description
	'fb_url' => 'http://fb.me/mirazmacofficial' // fb page/profile url
	);
```
#### Live Demo
http://mirazmac.info/opencric 

Thats all!
