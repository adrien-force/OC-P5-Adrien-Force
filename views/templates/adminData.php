<?php

/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */
function sortLinkSelector(string $input): string
{
    if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
        if ($_GET['sortData'] == $input && 'ASC' == $_GET['sortOrder']) {
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
    $output = '';
    if (isset($_GET['sortData'])) {
        if ($_GET['sortData'] == $input) {
            if ('ASC' == $_GET['sortOrder']) {
                $output = '▲';
            }
            if ('DESC' == $_GET['sortOrder']) {
                $output = '▼';
            }
        }
    }

    return $output;
}

?>

<div class="adminLinks">
    <h2><a href="index.php?action=admin"> Edition des articles </a></h2>
    <h2><a style="color: red" href="index.php?action=adminData"> Panel Data </a></h2>
</div>

<div class="adminArticle">

    <table>
        <tr>
            <th>
                <a href="index.php?action=adminData&sortData=title&sortOrder=<?php echo sortLinkSelector('title'); ?>">
                    Titre <?php echo showArrowBasedOnSortOrder('title'); ?> </a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=views&sortOrder=<?php echo sortLinkSelector('views'); ?>"> Nombres
                    de vues <?php echo showArrowBasedOnSortOrder('views'); ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=nbComments&sortOrder=<?php echo sortLinkSelector('nbComments'); ?>">
                    Nombre de commentaires <?php echo showArrowBasedOnSortOrder('nbComments'); ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=date_creation&sortOrder=<?php echo sortLinkSelector('date_creation'); ?>">
                    Date de creation <?php echo showArrowBasedOnSortOrder('date_creation'); ?></a>
            </th>
            <th>
                <a href="index.php?action=adminData&sortData=date_update&sortOrder=<?php echo sortLinkSelector('date_update'); ?>">
                    Date de mise à jour<?php echo showArrowBasedOnSortOrder('date_update'); ?></a>
            </th>
            <th></th>
            <th></th>
            <th></th>


        </tr>


        <?php if (isset($articles)) {
            foreach ($articles as $index => $article) { ?>
                <tr class="<?php echo 0 == $index % 2 ? 'even' : 'odd'; ?>">
                    <td><?php echo $article->getTitle(); ?></a></td>
                    <td><?php echo $article->getViews(); ?></td>
                    <td><?php echo $article->getNbComments(); ?></td>
                    <td><?php echo $article->getDateCreationString(); ?></td>
                    <td><?php echo $article->getDateUpdateString(); ?></td>
                    <td><a class="submit" href="index.php?action=showArticle&id=<?php echo $article->getId(); ?>">Details</a>
                    </td>
                    <td><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?php echo $article->getId(); ?>">Modifier</a>
                    </td>
                    <td><a class="submit"
                           href="index.php?action=deleteArticle&id=<?php echo $article->getId(); ?>" <?php echo Utils::askConfirmation('Êtes-vous sûr de vouloir supprimer cet article ?'); ?>>Supprimer</a>
                    </td>
                </tr>
            <?php }
            } ?>
    </table>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>