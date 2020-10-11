<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<P>
    Before start you can populate DB with your own URLs or default by overwriting config/urls.php
    <pre>php artisan db:seed</pre>
    Or
   <pre>php artisan url:seed</pre>
</p>

## About Captain Shortener API

<ul>
    <li>
GET {base_url}/api/
    </li>
     <li>
POST {base_url}/api/
<br/> &nbsp; parameter : <br/> &nbsp; url -> valid unique URL 
    </li>
     <li>
DELETE {base_url}/api/{short_url}
    </li>
</ul>

## About Captain Shortener cmd

<p> 
   <pre>   php artisan url:shorten {URL} </pre>
</p>
<p>Store a new URL entry in Db and give you the shorten link</p>
<p> 
   <pre>   php artisan url:delete {URL?} </pre>
</p>
<p>URL is an optional argument, if you don't use it, it will delete all entries after confirmation</p>
<p> 
   <pre>   php artisan url:seed </pre>
</p>
<p>Seed the DB with default URLs in config/urls.php</p>
<br/>
<p style="font-weight:bold">
    {URL} must be correctly formated like "https://github.com/" or cmd will throw you an error.
</p>

## About Captain Shortener site
<p>
    {base_url}/stats/
    <br/>
    Display stats for numbers of redirection for each Urls
</p>
<p>
    {base_url}/all/
    <br/>
    Display all long and short Urls related
</p>
<p>
    {base_url}/{short_url}
    <br/>
    Redirect to long URL 
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
