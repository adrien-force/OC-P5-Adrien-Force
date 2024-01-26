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
        <th>Titre</th>
        <th>Nombres de vues </th>
        <th>Nombre de commentaires </th>
        <th> Date de creation </th>
        <th> Date de mise à jour </th>
        <th></th>
        <th></th>
    </tr>
    <?php print_r($articles) ?>
    <?php foreach ($articles as $article) { ?>
        <tr>
            <td><?= $article->getTitle() ?></td>
            <td><?= $article->getViews() ?></td>
            <td><?= $article->getNbComments() ?></td>
            <td><?= $article->getDateCreationString()  ?></td>
            <td><?= $article->getDateUpdateString() ?></td>
            <td><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></td>
            <td><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a></td>
        </tr>
    <?php }  ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>