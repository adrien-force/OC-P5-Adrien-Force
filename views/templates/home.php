<?php
/**
 * Affichage de Liste des articles.
 */
?>

<div class="articleList">
    <?php foreach ($articles as $article) { ?>
        <article class="article">
            <h2><?php echo $article->getTitle(); ?></h2>
            <span class="quotation">«</span>
            <p><?php echo $article->getContent(400); ?></p>

            <div class="footer">
                <span class="info"> <?php echo ucfirst(Utils::convertDateToFrenchFormat($article->getDateCreation())); ?></span>
                <a class="info" href="index.php?action=showArticle&id=<?php echo $article->getId(); ?>">Lire +</a>
            </div>
        </article>
    <?php } ?>
</div>