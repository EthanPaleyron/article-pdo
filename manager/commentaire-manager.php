<?php
if (!isset($_SESSION["id"])) {
    header("Location: http://localhost/article-pdo/pages/index.php");
}
session_start();
try {
    include("connexion-base.php");
    $sql = "INSERT INTO `commentaires` (`LABEL_ARTICLE` ,`COMMENTAIRE_ARTICLE`, DATE_HEURS_COMMENTAIRE, `LABEL_COMMENTAIRE_UTILISATEUR`) VALUES (:id_article_comment , :comment, :datatime_comment, :label_user)";
    $statement = $base->prepare($sql);
    $statement->execute(
        array(
            "id_article_comment" => $_POST["id_article_comment"],
            "comment" => htmlspecialchars($_POST["comment"]),
            "datatime_comment" => date("Y-m-d H:i:s"),
            "label_user" => $_SESSION["id"]
        )
    );
    $statement->closeCursor();
    header("Location: http://localhost/article-pdo/pages/index.php");
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
?>