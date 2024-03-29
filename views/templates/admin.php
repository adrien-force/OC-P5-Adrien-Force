<?php
/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */
?>
<div class="adminLinks"> 
<h2> <a style="color: red" href="index.php?action=admin" > Edition des articles </a></h2>
<h2> <a href="index.php?action=adminData" > Panel Data  </a></h2>
</div>

<div class="adminArticle">
    <?php if (!empty($articles)) {
        foreach ($articles as $article) { ?>
            <div class="articleLine">
                <div class="title"><?= $article->getTitle() ?></div>
                <div class="content"><?= $article->getContent(200) ?></div>
                <div><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></div>
                <div><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a></div>
            </div>
        <?php }
        } ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>