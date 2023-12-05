<?php
session_start();
var_dump($_SESSION);
try {
    include("../manager/connexion-base.php");
    $sql = "SELECT LABEL_UTILISATEUR_ARTICLE FROM `articles` WHERE ID_ARTICLE = :id_article";
    $result = $base->prepare($sql);
    $result->execute(array("id_article" => $_POST["id_article"]));
    $result->closeCursor();
    if ($_SESSION["id"] != $e["LABEL_UTILISATEUR_ARTICLE"]) {
        header("Location: http://localhost/article-pdo/pages/index.php");
    }
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
try {
    include("../manager/connexion-base.php");
    $sql = "DELETE FROM `articles` WHERE ID_ARTICLE = :id_article";
    $file_to_delete = "files/" . $_POST["image_delete"];
    if (file_exists($file_to_delete)) {
        unlink($file_to_delete);
    }
    $deleteArticle = $base->prepare($sql);
    $deleteArticle->execute(array("id_article" => $_POST["id_article"]));
    $deleteArticle->closeCursor();
    // header("Location: http://localhost/article-pdo/pages/index.php");
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
try {
    include("../manager/connexion-base.php");
    $sql = "DELETE FROM `commentaires` WHERE LABEL_ARTICLE = :id_article";
    $deleteCommentaires = $base->prepare($sql);
    $deleteCommentaires->execute(array("id_article" => $_POST["id_article"]));
    $deleteCommentaires->closeCursor();
    // header("Location: http://localhost/article-pdo/pages/index.php");
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
try {
    include("../manager/connexion-base.php");
    $sql = "DELETE FROM `sou-commentaires` WHERE LABEL_COMMENTAIRE = :id_commentaire";
    $deleteSouCommentaires = $base->prepare($sql);
    $deleteSouCommentaires->execute(array("id_commentaire" => $_POST["id_commentaire"]));
    $deleteSouCommentaires->closeCursor();
    // header("Location: http://localhost/article-pdo/pages/index.php");
} catch (Exception $e) {
    throw new InvalidArgumentException($e->getMessage());
}
?>