<?php
/**
 * Ce template affiche un article et ses commentaires.
 * Il affiche également un formulaire pour ajouter un commentaire.
 */

if (isset($article)) {

    ?>

<article class="mainArticle">
    <h2> <?= Utils::format($article->getTitle()) ?> </h2>
    <span class="quotation">«</span>
    <p><?= Utils::format($article->getContent()) ?></p>

    <div class="footer">
        <span class="info"> Publié le <?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></span>
        <?php if ($article->getDateUpdate() != null) { ?>
            <span class="info"> Modifié le <?= Utils::convertDateToFrenchFormat($article->getDateUpdate()) ?></span>
        <?php } ?>
    </div>
</article>

<div class="comments">
    <h2 class="commentsTitle">Vos Commentaires</h2>
    <?php
        if (empty($comments)) {
            echo '<p class="info">Aucun commentaire pour cet article.</p>';
        } else {
            echo '<ul>';
            //TODO : Partial qui joue le role de template
            foreach ($comments as $comment) {
                include 'comment.php';
            }
            echo '</ul>';
        }
    ?>

    <form action="index.php" method="post" class="foldedCorner">
        <h2>Commenter</h2>

        <div class="formComment formGrid">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" name="pseudo" id="pseudo" required>

            <label for="content">Commentaire</label>
            <textarea name="content" id="content" required></textarea>

            <input type="hidden" name="action" value="addComment">
            <input type="hidden" name="idArticle" value="<?= $article->getId() ?>">

            <button class="submit">Ajouter un commentaire</button>
        </div>
    </form>
</div>

<?php
}
