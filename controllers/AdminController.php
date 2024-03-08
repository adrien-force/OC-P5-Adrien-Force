<?php
/**
 * Contrôleur de la partie admin.
 */
class AdminController
{
    //TODO FAIRE SORTIR LA LOGIQUE DE CONTROLLEUR -> DANS UN SERVICE
    //TODO DIFFERENCIER ADMIN / ADMIN DATA
    /**
     * Affiche la page d'administration.
     */
    public function showAdmin(): void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        // On affiche la page d'administration.
        $view = new View('Administration');
        $view->render('admin', [
            'articles' => $articles,
        ]);
    }

    /**
     * Affiche la page d'administration des données.
     */
    public function showAdminData(): void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        $sortData = $_GET['sortData'] ?? 'id';
        $sortOrder = $_GET['sortOrder'] ?? 'ASC';
        if ('false' === $sortOrder) {
            $sortOrder = false;
        }

        // On récupère les articles.
        $articleManager = new ArticleManager();

        if (isset($_GET['sortData']) || (isset($_GET['sortOrder']))) {
            $articles = $articleManager->getAllArticlesWithNbComments(sortData: $sortData, sortOrder: $sortOrder);
        } else {
            $articles = $articleManager->getAllArticlesWithNbComments();
        }

        // On affiche la page d'administration des données.
        $view = new View('Administration des données');
        $view->render('adminData', [
            'articles' => $articles,
        ]);
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     */
    private function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect('connectionForm');
        }
    }

    /**
     * Affichage du formulaire de connexion.
     */
    public function displayConnectionForm(): void
    {
        $view = new View('Connexion');
        $view->render('connectionForm');
    }

    /**
     * Connexion de l'utilisateur.
     *
     * @throws Exception
     */
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $login = Utils::request('login');
        $password = Utils::request('password');

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception('Tous les champs sont obligatoires. 1');
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['role'] = $user->getRole();

        // On redirige vers la page d'administration.
        Utils::redirect('admin');
    }

    /**
     * Déconnexion de l'utilisateur.
     */
    public function disconnectUser(): void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect('home');
    }

    /**
     * Affichage du formulaire d'ajout d'un article.
     */
    public function showUpdateArticleForm(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère l'id de l'article s'il existe.
        $id = Utils::request('id', -1);

        // On récupère l'article associé.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Si l'article n'existe pas, on en crée un vide.
        if (!$article) {
            $article = new Article();
        }

        // On affiche la page de modification de l'article.
        $view = new View("Edition d'un article");
        $view->render('updateArticleForm', [
            'article' => $article,
        ]);
    }

    /**
     * Ajout et modification d'un article.
     * On sait si un article est ajouté car l'id vaut -1.
     *
     * @throws Exception
     */
    public function updateArticle(): void
    {
        $this->checkIfUserIsConnected();

        // On récupère les données du formulaire.
        $id = Utils::request('id', -1);
        $title = Utils::request('title');
        $content = Utils::request('content');

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception('Tous les champs sont obligatoires. 2');
        }

        // On crée l'objet Article.
        $article = new Article([
            'id' => $id, // Si l'id vaut -1, l'article sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser'],
        ]);

        // On ajoute l'article.
        $articleManager = new ArticleManager();
        $articleManager->addOrUpdateArticle($article);

        // On redirige vers la page d'administration.
        Utils::redirect('admin');
    }

    /**
     * Suppression d'un article.
     */
    public function deleteArticle(): void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request('id', -1);

        // On supprime l'article.
        $articleManager = new ArticleManager();
        $articleManager->deleteArticle($id);

        // On redirige vers la page d'administration.
        Utils::redirect('admin');
    }
}
