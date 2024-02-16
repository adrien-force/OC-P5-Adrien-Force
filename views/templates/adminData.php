<?php

/** 
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
 * Et un formulaire pour ajouter un article. 
 */
?>

<div class="adminLinks"> 
<h2> <a href="index.php?action=admin" > Edition des articles </a></h2>
<h2> <a href="index.php?action=adminData" > Panel Data  </a></h2>
</div>

<div class="adminArticle">

    <table>
        <tr>
            <!--! TODO Refactor le selecteur de lien -->
            <th>
                <a href="index.php?action=adminData&sortData=title&sortOrder=<?php
                                                                                if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                    if ($_GET['sortData'] == "title" && $_GET['sortOrder'] == 'ASC') {
                                                                                        echo 'DESC';
                                                                                    } else {
                                                                                        echo 'ASC';
                                                                                    }
                                                                                } else {
                                                                                    echo 'ASC';
                                                                                }
                                                                                ?>"> Titre </a></th>
            <th>
                <a href="index.php?action=adminData&sortData=views&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                    if ($_GET['sortData'] == "views" && $_GET['sortOrder'] == 'ASC') {
                                                                                        echo 'DESC';
                                                                                    } else {
                                                                                        echo 'ASC';
                                                                                    }
                                                                                } else {
                                                                                    echo 'ASC';
                                                                                }
                                                                                ?>"> Nombres de vues </a></th>
            <th>
                <a href="index.php?action=adminData&sortData=nbComments&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                        if ($_GET['sortData'] == "nbComments" && $_GET['sortOrder'] == 'ASC') {
                                                                                            echo 'DESC';
                                                                                        } else {
                                                                                            echo 'ASC';
                                                                                        }
                                                                                    } else {
                                                                                        echo 'ASC';
                                                                                    }
                                                                                    ?>"> Nombre de commentaires </a></th>
            <th>
                <a href="index.php?action=adminData&sortData=date_creation&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                        if ($_GET['sortData'] == "date_creation" && $_GET['sortOrder'] == 'ASC') {
                                                                                            echo 'DESC';
                                                                                        } else {
                                                                                            echo 'ASC';
                                                                                        }
                                                                                    } else {
                                                                                        echo 'ASC';
                                                                                    }
                                                                                    ?>"> Date de creation </a></th>
            <th>
                <a href="index.php?action=adminData&sortData=date_update&sortOrder=<?php if (isset($_GET['sortOrder']) || (isset($_GET['sortData']))) {
                                                                                        if ($_GET['sortData'] == "date_update" && $_GET['sortOrder'] == 'ASC') {
                                                                                            echo 'DESC';
                                                                                        } else {
                                                                                            echo 'ASC';
                                                                                        }
                                                                                    } else {
                                                                                        echo 'ASC';
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
        </table>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>