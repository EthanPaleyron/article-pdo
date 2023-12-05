<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: http://localhost/article-pdo/pages/index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://kit.fontawesome.com/2621df78fc.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {
        echo '<h2>Changer de compte</h2>';
    } else {
        echo '<h2>Connexion</h2>';
    }
    ?>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <input type="text" name="user_name" placeholder="Ton nom d'utilisateur" autocomplete="off">
        <input id="password" type="password" name="password" placeholder="Ton mot de passe">
        <button id="eye" type="button"><i class="fa-solid fa-eye-slash"></i></button>
        <input type="submit" value="Connexion">
    </form>
    <?php
    if (isset($_POST["user_name"]) && isset($_POST["password"])) {
        include("../manager/connexion-base.php");
        $sql = "SELECT * FROM `utilisateurs` WHERE NOM_UTILISATEUR = :user_name";
        $resultat = $base->prepare($sql);
        $resultat->execute(array("user_name" => htmlspecialchars($_POST["user_name"])));
        if ($donnee = $resultat->fetch()) {
            if (password_verify($_POST["password"], $donnee["MDP_UTILISATEUR"])) {
                $_SESSION["id"] = $donnee["ID_UTILISATEUR"];
                $_SESSION["user_name"] = $_POST["user_name"];
                header("Location: http://localhost/article-pdo/pages/index.php");
            } else {
                echo "<p class='error'>Nom d'utilisateur incorect!</p>";
            }
        } else {
            echo "<p class='error'>Mots de passe incorect!</p>";
        }
        $resultat->closeCursor();
    }
    ?>
    <?php
    if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {
        echo "<a href='create-account.php'>Créer un nouveau compte</a>";
    } else {
        echo "<a href='create-account.php'>Je n'ai pas de compte</a>";
    }
    ?>
    <script type="module" src="../JS/password.js"></script>
</body>

</html>