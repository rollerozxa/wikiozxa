<?php

if (isset($_GET['logout'])) {
	setcookie('token', '', 0, '/');
	redirect('/');
}

$error = [];

if (isset($_POST['action'])) {
	$name = $_POST['name'] ?? null;
	$pass = $_POST['pass'] ?? null;

	$logindata = fetch("SELECT id,password,token FROM users WHERE name = ?", [$name]);

	if (!$name || !$pass || !$logindata || !password_verify($pass, $logindata['password'])) $error[] = 'Invalid credentials.';

	if ($error == []) {
		setcookie('token', $logindata['token'], 2147483647, '/');

		redirect('/');
	}
}

echo twigloader()->render('login.twig', ['error' => $error]);
