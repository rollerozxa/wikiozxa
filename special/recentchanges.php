<?php
$revisions = query("SELECT $userfields r.page, r.revision, r.size, r.sizediff, r.time, r.description FROM wikirevisions r JOIN users u ON r.author = u.id ORDER BY r.time DESC, r.id DESC LIMIT 50");

echo twigloader()->render('recentchanges.twig', [
	'revisions' => $revisions
]);
