<?php

$powerlevels = [
	-1 => 'Banned',
	0  => 'Guest',
	1  => 'Normal User',
	2  => 'Moderator',
	3  => 'Administrator',
	4  => 'Root',
];


/**
 * Return HTML code for an userlink, including stuff like custom colors
 *
 * @param array $user User array containing user fields. Retrieve this from the database using userfields().
 * @param string $pre $user key prefix.
 * @return string Userlink HTML code.
 */
function userlink($user, $pre = '') {
	return sprintf(
		'<a class="user" href="/user/%d"><span class="t_user">%s</span></a>',
	$user[$pre.'id'], $user[$pre.'name']);
}

/**
 * Get list of SQL SELECT fields for userlinks.
 *
 * @return string String to put inside a SQL statement.
 */
function userfields() {
	$fields = ['id', 'name'];

	$out = '';
	foreach ($fields as $field) {
		$out .= sprintf('u.%s u_%s,', $field, $field);
	}

	return $out;
}
