<?php

$randompage = result('SELECT title FROM wikipages ORDER BY RAND() LIMIT 1');

redirect('/wiki/'.$randompage);
