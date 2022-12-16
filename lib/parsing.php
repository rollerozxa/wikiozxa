<?php

function parsing($text) {
	$markdown = new ParsedownWiki();
	$markdown->setSafeMode(true);

	$text = $markdown->text($text);

	$text = preg_replace_callback('@{{ ([\w\d\.]+)\((.+?)\) }}@si', 'parseFunctions', $text);

	return $text;
}

function parseFunctions($match) {
	if (str_contains($match[1], '.') || !file_exists('scripts/'.$match[1].'.lua'))
		return '<span class="error">Template error: Invalid function name</span>';

	$cmd = sprintf(
		"luajit lib/lua/bootstrap.lua %s %s 2>&1",
	escapeshellarg($match[1]), escapeshellarg($match[2]));

	exec($cmd, $output);
	return implode('', $output);
}

/**
 * Normalise content by stripping carriage returns and trailing whitespace/newlines from the input.
 */
function normalise($text) {
	// I HATE CRLF I HATE CRLF
	return trim(str_replace("\r", "", $text));
}
