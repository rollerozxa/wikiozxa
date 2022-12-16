<?php
$pages = query("SELECT title FROM wikipages ORDER BY title ASC");

echo twigloader()->render('pageindex.twig', [
	'pages' => $pages
]);
