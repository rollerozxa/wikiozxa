<?php
$host = '127.0.0.1';
$db   = 'wiki';
$user = '';
$pass = '';

$tplCache = 'templates/cache';
$tplNoCache = false; // **DO NOT SET AS TRUE IN PROD - DEV ONLY**

// Array of memcached server(s) for memcache caching. Leave empty to disable memcache caching.
$memcachedServers = [];

// Website domain.
$domain = 'https://example.org';

// Stub function to put special information in the footer.
function customInfo() { }

// Stub function to put special information in the header.
function customHeader() { }
