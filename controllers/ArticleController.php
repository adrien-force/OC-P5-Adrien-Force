<?php

class ArticleController
{
    /**
     * Affiche la page d'accueil.
     */
    public function showHome(): void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View('Accueil');
        $view->render('home', ['articles' => $articles]);
    }

    /**
     * Affiche le détail d'un article.
     *
     * @throws Exception
     */
    public function showArticle(): void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request('id', -1);

        $articleManager = new ArticleManager();
        $articleManager->increaseViews($id);
        $article = $articleManager->getArticleById($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByArticleId($id);

        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        $view = new View($article->getTitle());
        $view->render('detailArticle', ['article' => $article, 'comments' => $comments]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     */
    public function addArticle(): void
    {
        $view = new View('Ajouter un article');
        $view->render('addArticle');
    }

    /**
     * Affiche la page "à propos".
     */
    public function showApropos(): void
    {
        $view = new View('A propos');
        $view->render('apropos');
    }
}
