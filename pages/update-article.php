<?php
session_start();
try {
    include("../manager/connexion-base.php");
    $sql = "SELECT LABEL_UTILISATEUR_ARTICLE FROM `articles` WHERE ID_ARTICLE = " . $_GET["id_article"];
    $result = $base->query($sql);
    $e = $result->fetch();
    if ($_SESSION["id"] != $e["LABEL_UTILISATEUR_ARTICLE"]) {
        header("Location: http://localhost/article-pdo/pages/index.php");
    }
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Modification de l'article</h2>

    <?php
    include("../manager/connexion-base.php");
    $sql = "SELECT NOM_ARTICLE, IMAGE_ARTICLE, DESCRIPTION_ARTICLE FROM `articles` WHERE ID_ARTICLE = " . $_GET["id_article"];
    $result = $base->query($sql);
    $e = $result->fetch();
    $image = $e["IMAGE_ARTICLE"];
    echo '<form action="update-article.php?id_article=' . $_GET["id_article"] . '" method="post" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" name="name" value="' . $e["NOM_ARTICLE"] . '" id="title">
        <input type="file" name="file" value="' . $e["IMAGE_ARTICLE"] . '">
        <img src="files/' . $e["IMAGE_ARTICLE"] . '" alt="' . $e["IMAGE_ARTICLE"] . '">
        <label for="comment">Description:</label>
        <textarea name="comment" cols="30" rows="10" id="comment">' . $e["DESCRIPTION_ARTICLE"] . '</textarea>
        <input type="submit">
    </form>';
    ?>
    <?php
    if (isset($_POST["name"]) || isset($_POST["comment"])) {
        try {
            include("../manager/connexion-base.php");
            $sql = 'UPDATE `articles` SET NOM_ARTICLE = :name, DATE_HEURE_ARTICLE = :datetime, IMAGE_ARTICLE = :file, DESCRIPTION_ARTICLE = :comment WHERE ID_ARTICLE =' . $_GET["id_article"];
            $statement = $base->prepare($sql);
            if (isset($_FILES["file"]) && $_FILES["file"]["size"] > 0) {
                unlink("files/" . $image);
                $image = rand(0, 100000000000) . $_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $image);
            } else {
                $image = $e["IMAGE_ARTICLE"];
            }
            $statement->execute(array("name" => htmlspecialchars($_POST["name"]), "datetime" => date("Y-m-d H:i:s"), "file" => $image, "comment" => htmlspecialchars($_POST["comment"])));
            $statement->closeCursor();
            header("Location: http://localhost/article-pdo/pages/index.php");
        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
    ?>
</body>

</html>