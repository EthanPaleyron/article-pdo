<?php
if (!isset($_SESSION["id"])) {
    header("Location: http://localhost/article-pdo/pages/index.php");
}
session_start();
try {
    include("connexion-base.php");
    $sql = "INSERT INTO `sou-commentaires` (LABEL_COMMENTAIRE, SOU_COMMENTAIRE, DATE_HEURE_SOU_COMMENTAIRE, LABEL_SOU_COMMENTAIRE_UTILISATEUR) VALUES (:label_comment, :sou_comment, :datatime_sou_commentaire, :label_user_sou_commentaire)";
    $statement = $base->prepare($sql);
    $statement->execute(array("label_comment" => $_POST["id_comment_sou_comment"], "sou_comment" => htmlspecialchars($_POST["sou_comment"]), "datatime_sou_commentaire" => date("Y-m-d H:i:s"), "label_user_sou_commentaire" => $_SESSION["id"]));
    $statement->closeCursor();
    header("Location: http://localhost/article-pdo/pages/index.php");
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
?>