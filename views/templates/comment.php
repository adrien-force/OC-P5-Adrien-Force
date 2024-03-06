<?php
/**
 * Ce template affiche un commentaire.
 * Il est utilisé dans detailArticle.php.
 */
?>

<li>
    <div class="smiley">☻</div>
    <div class="detailComment">
        <h3 class="info">Le <?= Utils::convertDateToFrenchFormat($comment->getDateCreation()) ?>, <?= Utils::format($comment->getPseudo()) ?> a écrit :</h3>
        <p class="content"><?= Utils::format($comment->getContent()) ?></p>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 'admin'): ?>
            <div><br><a class="submit supprComment" href="index.php?action=deleteComment&id=<?= $comment->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce commentaire ?") ?>>Supprimer</a></div>
        <?php endif; ?>
    </div>
</li>