<?php

$error = [];

if (isset($_POST['action'])) {
	$name = trim($_POST['name'] ?? null);
	$pass = $_POST['pass'] ?? null;
	$pass2 = $_POST['pass2'] ?? null;

	if (!$name)
		$error[] = 'Blank username.';

	if (!$pass || strlen($pass) < 6)
		$error[] = 'Password is too short.';

	if (!$pass2 || $pass != $pass2)
		$error[] = "The passwords don't match.";

	if (result("SELECT COUNT(*) FROM users WHERE LOWER(name) = ?", [strtolower($name)]))
		$error[] = "Username has already been taken.";

	if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $name))
		$error[] = "Username contains invalid characters (Only alphanumeric and underscore allowed).";

	//if (result("SELECT COUNT(*) FROM users WHERE ip = ?", [$ipaddr]))
	//	$error[] = "Creating multiple accounts (alts) aren't allowed.";

	if ($error == []) {
		$token = bin2hex(random_bytes(20));
		query("INSERT INTO users (name, password, token, joined) VALUES (?,?,?,?)",
			[$name, password_hash($pass, PASSWORD_DEFAULT), $token, time()]);

		setcookie('token', $token, 2147483647);

		redirect('/?rd');
	}
}

echo twigloader()->render('createaccount.twig', ['error' => $error]);
