# CodeIgniter 4 Application Route Speed test
## Settings

Setting in app/Config/Events.php 
[Set Events](app/Config/Events.php).

Setting in app/Config/Routes.php 
[Set Route](app/Config/Routes.php).

Setting in app/Controllers/Home.php 
[Set Home](app/Controllers/Home.php).

## Testing

1. Start your app
2. `/1` or `/index.php/1` to test route can set number(`/?`)sec for test speed
3. `/` or `/index.php` to see log
   
## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
