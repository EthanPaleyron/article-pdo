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
    <title>Créer un compte</title>
    <script src="https://kit.fontawesome.com/2621df78fc.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {
        echo '<h2>Créer un nouveau compte</h2>';
    } else {
        echo '<h2>Créer un compte</h2>';
    }
    ?>
    <form action="create-account.php" method="post" enctype="multipart/form-data">
        <input type="text" name="user_name" placeholder="Nom d'utilisateur" autocomplete="off">
        <input id="password" type="password" name="password" placeholder="Mot de passe">
        <button id="eye" type="button"><i class="fa-solid fa-eye-slash"></i></button>
        <input type="submit" value="Créer mon compte">
    </form>
    <?php
    if (isset($_POST["user_name"]) && isset($_POST["password"])) {
        try {
            include("../manager/connexion-base.php");
            $sql = "INSERT INTO `utilisateurs` (`NOM_UTILISATEUR`, `MDP_UTILISATEUR`) VALUES (:user_name, :password)";
            if (!preg_match("/[ \[\]\(\)#~`\\£\$€µ<>%§]/", $_POST["user_name"]) && strlen($_POST["user_name"]) > 1 && strlen($_POST["password"]) >= 8) {
                $statement = $base->prepare($sql);
                $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $statement->execute(array("user_name" => htmlspecialchars($_POST["user_name"]), "password" => $passwordHash));
                $id = $base->lastInsertId();
                $statement->closeCursor();
                $_SESSION["id"] = $id;
                $_SESSION["user_name"] = $_POST["user_name"];
                header("Location: http://localhost/article-pdo/pages/index.php");
            } else if (preg_match("/[ \[\]\(\)#~`\\£\$€µ<>%§]/", $_POST["user_name"]) || strlen($_POST["user_name"]) < 1) {
                echo "<p>Votre nom d'utilisateur ne doit pas contenir des caractere speciaux</p>";
            } else if (strlen($_POST["password"]) <= 8) {
                echo "<p>Votre mots de passe doit contenir minimum 8</p>";
            }
        } catch (Exception $e) {
            if ($e->getCode() === "23000") {
                echo "<p>Ce nom d'utilisateur est déjà pris</p>";
            } else {
                throw new InvalidArgumentException($e->getMessage());
            }
        }
    }
    ?>
    <?php
    if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {
        echo "<a href='login.php'>Changer de compte</a>";
    } else {
        echo "<a href='login.php'>J’ai déjà un compte</a>";
    }
    ?>
    <script type="module" src="../JS/password.js"></script>
</body>

</html>