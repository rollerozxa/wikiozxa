<?php

/**
 * Returns true if it is executed from the command-line. (For command-line tools)
 */
function isCli() {
	return php_sapi_name() == "cli";
}

/**
 * Get hash of latest git commit
 *
 * @param bool $trim Trim the hash to the first 7 characters
 * @return void
 */
function gitCommit($trim = true) {
	global $acmlm;

	$prefix = ($acmlm ? '../' : '');

	$commit = file_get_contents($prefix.'.git/refs/heads/master');

	if ($trim)
		return substr($commit, 0, 7);
	else
		return rtrim($commit);
}
