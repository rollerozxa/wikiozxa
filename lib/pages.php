<?php

function checkPageExistance($pagename) {
	global $cache;

	return $cache->hit('wpe_'.base64_encode($pagename), function () use ($pagename) {
		return result("SELECT COUNT(*) FROM wikipages WHERE BINARY title = ?", [$pagename]);
	}) == 1;
}
