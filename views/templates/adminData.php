<?php

/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */

function sortLinkSelector(string $input): string
{
    if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
        if ($_GET['sortData'] == $input && $_GET['sortOrder'] == 'ASC') {
            $output = 'DESC';
        } else {
            $output = 'ASC';
        }
    } else {
        $output = 'ASC';
    }
    return $output;
}

function showArrowBasedOnSortOrder(string $input): string
{
    $output = "";
    if ($_GET['sortData'] == $input) {
        if ($_GET['sortOrder'] == 'ASC') {
            $output = '▲';
        }
        if ($_GET['sortOrder'] == 'DESC') {
            $output = '▼';
        }
    }
    return $output;
}

?>

<div class="adminLinks">
    <h2><a href="index.php?action=admin"> Edition des articles </a></h2>
    <h2><a href="index.php?action=adminData"> Panel Data </a></h2>
</div>

<div class="adminArticle">

    <table>
        <tr>
            <th>
                <a href="index.php?action=adminData&sortData=title&sortOrder=<?= sortLinkSelector('title') ?>">
                    Titre <?= showArrowBasedOnSortOrder('title') ?> </a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=views&sortOrder=<?= sortLinkSelector('views') ?>"> Nombres
                    de vues <?= showArrowBasedOnSortOrder('views') ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=nbComments&sortOrder=<?= sortLinkSelector('nbComments') ?>">
                    Nombre de commentaires <?= showArrowBasedOnSortOrder('nbComments') ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=date_creation&sortOrder=<?= sortLinkSelector('date_creation') ?>">
                    Date de creation <?= showArrowBasedOnSortOrder('date_creation') ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=date_update&sortOrder=<?= sortLinkSelector('date_update') ?>">
                    Date de mise à jour<?= showArrowBasedOnSortOrder('date_update') ?></a>
            </th>
            <th></th>
            <th></th>
            <th></th>


        </tr>


        <?php if (isset($articles)) {
            foreach ($articles as $index => $article) { ?>
                <tr class="<?= $index % 2 == 0 ? 'even' : 'odd' ?>">
                    <td><?= $article->getTitle()?></a></td>
                    <td><?= $article->getViews() ?></td>
                    <td><?= $article->getNbComments() ?></td>
                    <td><?= $article->getDateCreationString() ?></td>
                    <td><?= $article->getDateUpdateString() ?></td>
                    <td><a class="submit" href="index.php?action=showArticle&id=<?= $article->getId() ?>">Details</a>
                    </td>
                    <td><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a>
                    </td>
                    <td><a class="submit"
                           href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?>>Supprimer</a>
                    </td>
                </tr>
            <?php }
        } ?>
    </table>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>