<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles() : array
    {
        $sql = <<<SQL
        SELECT * FROM article
        SQL;
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    /**
     * Récupère tous les articles avec le nombre de commentaires associés.
     * @param string|null $sortData : la colonne de tri.
     * @param string|null $sortOrder : l'ordre de tri.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticlesWithNbComments(string $sortData = null, string $sortOrder = null) : array
    {
        $orderMapping = [
            'ASC' => 'ASC',
            'DESC' => 'DESC'
        ];
        
        $columnMapping = [
            'id' => 'article.id',
            'title' => 'article.title',
            'content' => 'article.content',
            'date_creation' => 'article.date_creation',
            'date_update' => 'article.date_update',
            'id_user' => 'article.id_user',
            'views' => 'article.views',
            'nbComments' => 'COUNT(comment.id)'
        ];
        
        $sql = <<<SQL
        SELECT article.*, COUNT(comment.id) AS nbComments 
        FROM article 
        LEFT JOIN comment ON article.id = comment.id_article 
        GROUP BY article.id
        SQL;
        
        if ($sortData && $sortOrder) {
            if (array_key_exists($sortData, $columnMapping)) {
                $sql .= " ORDER BY $columnMapping[$sortData] $orderMapping[$sortOrder]";
            }
        }
        
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = <<<SQL
        SELECT * FROM article WHERE id = :id
        SQL;
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Augmente de 1 le nombre de vues d'un article.
     * @param int $id : l'id de l'article.
     * @return void
     */
    public function increaseViews(int $id) : void
    {
        $sql = <<<SQL
        UPDATE article 
        SET views = views + 1 
        WHERE id = :id
        SQL;
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = <<<SQL
        INSERT INTO article (id_user, title, content, date_creation) 
        VALUES (:id_user, :title, :content, NOW())
        SQL;
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = <<<SQL
        UPDATE article 
        SET title = :title, content = :content, date_update = NOW() 
        WHERE id = :id
        SQL;
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = <<<SQL
        DELETE FROM article 
        WHERE id = :id
        SQL;
        $this->db->query($sql, ['id' => $id]);
    }
}