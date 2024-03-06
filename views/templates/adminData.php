<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
<?php

/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */
function sortLinkSelector(string $input): string
{
    $output = '';
    $sortData = $_GET['sortData'] ?? null;
    $sortOrder = $_GET['sortOrder'] ?? 'ASC';

    if ($sortData === $input) {
        if ('ASC' === $sortOrder) {
            $output = 'DESC';
        } else {
            $output = 'ASC';
        }
    }

    return $output;
}

function showArrowBasedOnSortOrder(string $input): string
{
    $output = '';
    $sortData = $_GET['sortData'] ?? null;
    $sortOrder = $_GET['sortOrder'] ?? null;

    if ($sortData === $input) {
        if ('ASC' === $sortOrder) {
            $output = '▲';
        } else {
            $output = '▼';
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
                <a href="index.php?action=adminData&sortData=id&sortOrder=<?php echo sortLinkSelector('id'); ?>"> ID
                    <?php echo showArrowBasedOnSortOrder('id'); ?></a>
            </th>
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
                    <td><?php echo $article->getId(); ?></td>
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

<div>
    <style>
        .graph {
            width: 700px;
            height: 300px;
            border: 1px solid #ccc;
            margin: 20px auto;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }
        .bar {
            background-color: #3498db;
            width: 20px; /* Change this value to adjust the width of bars */
            position: absolute;
            bottom: 0;
        }
        .bar:nth-child(1) { left: 30px; }
        .bar:nth-child(2) { left: 80px; }
        .bar:nth-child(3) { left: 130px; }
        /* Add more .bar:nth-child() styles for additional bars */
        .label {
            text-align: center;
            margin-top: 10px;
        }
    </style>
    </head>
    <body>
    <div class="graph">
        <div class="bar" style="height: 150px;"></div> <!-- Change height for each bar -->
        <div class="bar" style="height: 200px;"></div>
        <div class="bar" style="height: 100px;"></div>
        <!-- Add more <div class="bar"></div> elements for additional bars -->
        <div class="label">Bar 1</div>
        <div class="label">Bar 2</div>
        <div class="label">Bar 3</div>
        <!-- Add more <div class="label">...</div> elements for additional labels -->
    </div>
</div>

