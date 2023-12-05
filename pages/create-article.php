<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: http://localhost/article-pdo/pages/index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation d'un nouvel article</title>
</head>

<body>
    <h2>Creation d'un nouvel article</h2>

    <form action="create-article.php" method="post" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" name="name" id="title">
        <input type="file" name="image">
        <label for="comment">Description:</label>
        <textarea name="comment" cols="30" rows="10" id="comment"></textarea>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST["name"]) && isset($_FILES["image"]) && isset($_POST["comment"])) {
        try {
            include("../manager/connexion-base.php");
            $sql = 'INSERT INTO `articles` (LABEL_UTILISATEUR_ARTICLE, NOM_ARTICLE, DATE_HEURE_ARTICLE, IMAGE_ARTICLE, DESCRIPTION_ARTICLE) VALUES (:label_user, :name, :datetime, :file, :comment)';
            $statement = $base->prepare($sql);
            $image = rand(0, 10000000) . $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], "files/" . $image);
            $statement->execute(array("label_user" => $_SESSION["id"], "name" => htmlspecialchars($_POST["name"]), "datetime" => date("Y-m-d H:i:s"), "file" => $image, "comment" => htmlspecialchars($_POST["comment"])));
            $statement->closeCursor();
            header("Location: http://localhost/article-pdo/pages/index.php");
        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
    ?>
</body>

</html>