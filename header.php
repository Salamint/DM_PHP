<?php
// Initialisation du fichier d'entête et des informations communes à toutes les pages
// (comme le CSS, l'entête HTML, le nombre de visiteurs et la connection à la base de données...).
$nombreDeVisiteurs = 1;

/**
 * Une fonction permettant de récupérer un attribut de session, de le convertir en chaîne de caractère
 * et d'en échapper le code HTML/CSS/JS, afin de l'afficher, pour gagner du temps et empêcher l'insertion de code malveillant.
 * Exemple :
 * <p><?=session_attribute("username")?></p>
 * Au lieu de :
 * <p><?=htmlspecialchars((string) $_SESSION["username"])?></p>
 */
function session_attribute(string $attribute) : string
{
	// Convertit l'attribut de session récupéré en chaîn e de caractères.
	$attribute = (string) $_SESSION[$attribute];
	// Echappe le code HTML/CSS/JS potentiellement inséré.
	return htmlspecialchars($attribute);
}

function end_session()
{
	if (session_id())
	{
		session_unset();
		session_destroy();
	}
}

function init_session() : bool
{
	if (!session_id())
	{
		session_start();
		session_regenerate_id();
		return true;
	}
	return false;
}


function is_logged() : bool
{
	return isset($_SESSION['username']) and isset($_SESSION['password']);
}


init_session();

if (isset($_POST['disconnect']))
    end_session();
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Site marchand</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<header>
			<nav>
				<a href="index.php"><button id="icon">Site Marchand</button></a>
				<?php if(is_logged()): ?>
					<form action="index.php" method="POST">
						<input id="disconnect" name="disconnect" type="submit" value="Déconnexion">
					</form>
				<?php endif; ?>
			</nav>
