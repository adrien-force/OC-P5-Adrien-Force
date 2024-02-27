<?php
/**
 * Template du formulaire d'update/creation d'un article.
 */
?>

<form action="index.php" method="post" class="foldedCorner">
    <h2><?php echo -1 == $article->getId() ? "Création d'un article" : "Modification de l'article "; ?></h2>
    <div class="formGrid">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?php echo $article->getTitle(); ?>" required>
        <label for="content">Contenu</label>
        <textarea name="content" id="content" cols="30" rows="10" required><?php echo $article->getContent(); ?></textarea>
        <input type="hidden" name="action" value="updateArticle">
        <input type="hidden" name="id" value="<?php echo $article->getId(); ?>">
        <button class="submit"><?php echo -1 == $article->getId() ? 'Ajouter' : 'Modifier'; ?></button>
    </div>
</form>

<script>


</script>