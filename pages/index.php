<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout les articles</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <nav>
        <a href="index.php">
            <h1>Article-PDO</h1>
        </a>
        <ul>
            <?php
            if (isset($_SESSION["id"])) {
                echo '<li><a href="../manager/logout-manager.php">Deconnexion</a></li>';
            } else {
                echo '<li><a href="create-account.php">Créer un compte</a></li>
            <li><a href="login.php">Connexion</a></li>';
            }
            ?>
        </ul>
        <?php
        if (isset($_SESSION["id"])) {
            echo "<p>Connecter en tant que " . $_SESSION["user_name"] . "</p>";
        }
        ?>
    </nav>

    <h2>Tout les articles</h2>
    <?php
    if (isset($_SESSION["id"])) {
        echo '<a href="create-article.php">Créer un nouvel article</a>';
    }
    ?>

    <div class="articles">
        <?php
        try {
            include("../manager/connexion-base.php");
            $sql = "SELECT * FROM `articles` ORDER BY DATE_HEURE_ARTICLE";
            $result = $base->query($sql);
            while ($e = $result->fetch()) {
                $datetime = new DateTime($e["DATE_HEURE_ARTICLE"]);
                echo '<article>
                <h2>' . $e["NOM_ARTICLE"] . '</h2>
                <time datetime="' . $datetime->format("d-m-Y H:i:s") . '">' . $datetime->format("d-m-Y H:i:s") . '</time>
                <img src="files/' . $e["IMAGE_ARTICLE"] . '" alt="' . $e["IMAGE_ARTICLE"] . '">
                <p>' . $e["DESCRIPTION_ARTICLE"] . '</p>';
                if (isset($_SESSION["id"])) {
                    if ($_SESSION["id"] == $e["LABEL_UTILISATEUR_ARTICLE"]) {
                        echo '<a href="update-article.php?id_article=' . $e["ID_ARTICLE"] . '">Modifier</a>
                        <form action="../manager/delete-manager.php?id_article=' . $e["ID_ARTICLE"] . '" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="image_delete" value="' . $e["IMAGE_ARTICLE"] . '">';
                        try {
                            include("../manager/connexion-base.php");
                            $sql = "SELECT ID_COMMENTAIRE FROM `commentaires` WHERE LABEL_ARTICLE = " . $e["ID_ARTICLE"];
                            $idCommentaires = $base->query($sql);
                            $commentaires = $idCommentaires->fetch();
                            if ($commentaires != "") {
                                echo '<input type="hidden" name="id_sou_commentaires" value="' . $commentaires["ID_COMMENTAIRE"] . '">';
                            }
                        } catch (Exception $e) {
                            throw new InvalidArgumentException($e->getMessage());
                        }
                        echo '<input type="submit" value="Supprimer">
                    </form>';
                    }
                }
                echo '<form action="../manager/commentaire-manager.php" method="post" enctype="multipart/form-data">
                    <label for="comment">Ajouter un commentaire:</label>
                    <input type="text" name="comment" id="comment">
                    <input type="hidden" name="id_article_comment" value="' . $e["ID_ARTICLE"] . '">
                    <input type="submit" value="Envoyer">
                </form>';
                echo '<ul>';
                try {
                    include("../manager/connexion-base.php");
                    $sql = "SELECT * FROM `commentaires` WHERE LABEL_ARTICLE = :label_article ORDER BY DATE_HEURS_COMMENTAIRE";
                    $commentaires = $base->prepare($sql);
                    $commentaires->execute(array("label_article" => $e["ID_ARTICLE"]));
                    while ($e = $commentaires->fetch()) {
                        echo '<li>' . $e["COMMENTAIRE_ARTICLE"] . '
                        <form action="../manager/sou-commentaire-manager.php" method="post" enctype="multipart/form-data">
                            <label for="sou_comment">Ajouter un sou-commentaire:</label>
                            <input type="text" name="sou_comment" id="sou_comment">
                            <input type="hidden" name="id_comment_sou_comment" value="' . $e["ID_COMMENTAIRE"] . '">
                            <input type="submit" value="Envoyer">
                        </form>
                        <ul>';
                        try {
                            include("../manager/connexion-base.php");
                            $sql = "SELECT * FROM `sou-commentaires` WHERE LABEL_COMMENTAIRE = :label_commentaire ORDER BY DATE_HEURE_SOU_COMMENTAIRE";
                            $souCommentaires = $base->prepare($sql);
                            $souCommentaires->execute(array("label_commentaire" => $e["ID_COMMENTAIRE"]));
                            while ($e = $souCommentaires->fetch()) {
                                echo '<li>' . $e["SOU_COMMENTAIRE"] . '</li>';
                            }
                        } catch (Exception $e) {
                            throw new InvalidArgumentException($e->getMessage());
                        }
                        echo '</ul></li>';
                    }
                } catch (Exception $e) {
                    throw new InvalidArgumentException($e->getMessage());
                }
                echo '</ul>
                </article>';
            }
            $result->closeCursor();
        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
        ?>
    </div>
</body>

</html>