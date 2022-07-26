<?php

function debug($variableToDebug)
{
	echo "<pre>";
	var_dump($variableToDebug);
	echo "</pre>";

	exit;
}

/**
 * A function that is used to sanitize the html code.
 *
 * @param html The HTML to be escaped.
 *
 * @return string the htmlspecialchars() function.
 */
function s($html): string
{
	return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
}

function isTheLastElement($currentElement, $nextElement): bool
{
	if ($currentElement !== $nextElement) return true;

	return false;
}

function isAuthenticated(): void
{
	if (!isset($_SESSION['isLogged'])) header('Location: /');
}

function isAdmin(): void
{
	if (!isset($_SESSION['isAdmin'])) header('Location: /');
}
