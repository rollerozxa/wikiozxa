# wikiozxa
Minimal Wiki software in PHP, forked off principia-web-wiki.

It is currently not recommended to be used by others, as it's rather barebones and technical. If you want to use it you will most likely have to fork it for your own use.

I'm currently using it for the [Cirrusboard Wiki](https://cirrus.voxelmanip.se) and the [Voxelmanip Classic Wiki](https://classic.voxelmanip.se).

## Set-up notes
Requires some environment with PHP and MariaDB available, install Composer dependencies, compile SCSS stylesheets, import the database dump, all of that stuff...

The software expects requests to `/wiki/` to go through the "router" script `/index.php`. You will need to use URL rewriting to make this happen. This is an example for how I do it, using nginx:

```nginx
location /wiki {
	rewrite ^/wiki/(?<pagename>.*)$ /?page=$1 last;
}
```
