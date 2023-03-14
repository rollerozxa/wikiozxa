<?php
$host = '127.0.0.1';
$db   = 'wiki';
$user = '';
$pass = '';

$tplCache = 'templates/cache';
$tplNoCache = false; // **DO NOT SET AS TRUE IN PROD - DEV ONLY**

// Array of memcached server(s) for memcache caching. Leave empty to disable memcache caching.
$memcachedServers = [];
$memcachedPrefix = '';

// Customise your wiki
$config['title'] = "Wiki";
$config['description'] = "A very cool wiki.";
$config['logo'] = 'assets/logo.png';

// Allow registrations?
$config['allowregistrations'] = false;
