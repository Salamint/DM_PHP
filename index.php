<?php
include 'header.php';

if (isset($_POST['valid_connection']))
{
    $username;
    $password;

    if (isset($_POST['username']) and !empty($_POST['username']))
        $username = $_POST['username'];
    if (isset($_POST['password']) and !empty($_POST['password']))
        $password = $_POST['password'];
    
    if (isset($username) and isset($password))
    {
        if ($username == "fb" and $password == "fb")
        {
            $_SESSION['username'] = htmlspecialchars($username);
            $_SESSION['password'] = htmlspecialchars($password);
        }
    }
}
?>

</header>
<section>
    <?php if(is_logged()): ?>
        <h1>Bienvenue sur notre site marchand <?=$_SESSION['username']?> !</h1>
        <p><a href="formulaire.html">Voir les articles en vente.</a></p>
        <?php
        if (
            isset($_SESSION['cart']) and !empty($_SESSION['cart'])
            and isset($_SESSION['command']) and !empty($_SESSION['command'])
        ):
        ?>
            <p>Vos articles dans le panier sont :</p>
            <ul>
                <?php if (isset($_SESSION['cart']['OnePiece']) and !empty($_SESSION['cart']['OnePiece'])): ?>
                    <li><?=$_SESSION['cart']['OnePiece']?> manga(s) de One Piece</li>
                <?php endif; ?>
                <?php if (isset($_SESSION['cart']['Naruto']) and !empty($_SESSION['cart']['Naruto'])): ?>
                    <li><?=$_SESSION['cart']['Naruto']?> manga(s) de Naruto</li>
                <?php endif; ?>
            </ul>
            <form action="recapitulatif.php" method="POST">
                <?php
                foreach(array_keys($_SESSION['command']) as $fieldName)
                    echo '<input name="'.$fieldName.'" type="hidden" value="'.$_SESSION['command'][$fieldName].'">';
                ?>
                <input name="valid_cart" type="submit" value="Finaliser la commande">
            </form>
        <?php endif; ?>
    <?php else: ?>
        <h2>Connectez-vous pour effectuer un achat.</h2>
        <hr>
        <form action="index.php" id="connection-form" method="POST">
            <h3>Connexion :</h3>
            <input class="connection-input" name="username" placeholder="Identifiant" required type="text">
            <input class="connection-input" name="password" placeholder="Mot de passe" required type="password">
            <input name="action" type="hidden" value="connect">
            <input id="submit-connection" name="valid_connection" type="submit" value="Connexion">
        </form>
    <?php endif; ?>
</section>

<?php include 'footer.php' ?>