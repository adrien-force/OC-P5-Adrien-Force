<?php

/** 
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
 * Et un formulaire pour ajouter un article. 
 */
?>

<h2>DATA PANEL</h2>

<div class="adminArticle">

    <table>
        <!-- Need to a link to every th to sort them using sortObjects -->
        <tr>
            <!--! TODO Refactor le selecteur de lien -->
            <th><a href="index.php?action=adminData&sortData=title&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                    if ($_GET['sortData'] == "title" && $_GET['sortOrder'] == 'true') {
                                                                                        echo 'false';
                                                                                    } else {
                                                                                        echo 'true';
                                                                                    }
                                                                                } else {
                                                                                    echo 'true';
                                                                                }
                                                                                ?>"> Titre </a></th>
            <th><a href="index.php?action=adminData&sortData=views&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                    if ($_GET['sortData'] == "views" && $_GET['sortOrder'] == 'true') {
                                                                                        echo 'false';
                                                                                    } else {
                                                                                        echo 'true';
                                                                                    }
                                                                                } else {
                                                                                    echo 'true';
                                                                                }
                                                                                ?>"> Nombres de vues </a></th>
            <th><a href="index.php?action=adminData&sortData=nbComments&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                        if ($_GET['sortData'] == "nbComments" && $_GET['sortOrder'] == 'true') {
                                                                                            echo 'false';
                                                                                        } else {
                                                                                            echo 'true';
                                                                                        }
                                                                                    } else {
                                                                                        echo 'true';
                                                                                    }
                                                                                    ?>"> Nombre de commentaires </a></th>
            <th><a href="index.php?action=adminData&sortData=dateCreation&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                            if ($_GET['sortData'] == "dateCreation" && $_GET['sortOrder'] == 'true') {
                                                                                                echo 'false';
                                                                                            } else {
                                                                                                echo 'true';
                                                                                            }
                                                                                        } else {
                                                                                            echo 'true';
                                                                                        }
                                                                                        ?>"> Date de creation </a></th>
            <th><a href="index.php?action=adminData&sortData=dateUpdate&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                            if ($_GET['sortData'] == "dateUpdate" && $_GET['sortOrder'] == 'true') {
                                                                                                echo 'false';
                                                                                            } else {
                                                                                                echo 'true';
                                                                                            }
                                                                                        } else {
                                                                                            echo 'true';
                                                                                        }
                                                                                        ?>"> Date de mise à jour </a></th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <td><?= $article->getTitle() ?></td>
                <td><?= $article->getViews() ?></td>
                <td><?= $article->getNbComments() ?></td>
                <td><?= $article->getDateCreationString()  ?></td>
                <td><?= $article->getDateUpdateString() ?></td>
                <td><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></td>
                <td><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?>>Supprimer</a></td>
            </tr>
        <?php }  ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>