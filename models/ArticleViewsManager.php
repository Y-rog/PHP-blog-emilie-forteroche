<?php

/**
 * Classe qui gère le nombre de vues des articles.
 */
class ArticleViewsManager extends AbstractEntityManager
{
    /**
     * Récupère le nombre de vues d'un article.
     * @param int $article_id : l'id de l'article.
     * @return ArticleViews ou null : l'entité ArticleViews ou null si l'article n'a pas de vues.
     */
    public function getArticleViews(int $id_article) : ?ArticleViews
    {
        $sql = "SELECT * FROM article_views WHERE id_article = :id_article";
        $result = $this->db->query($sql, ['id_article' => $id_article]);
        $articleViews = $result->fetch();
        if ($articleViews) {
            return new ArticleViews($articleViews);
        }
        return null;

    }

    /**
     * Créer un nouvel objet ArticleViews pour un article.
     * @param ArticleViews $articleViews : l'entité ArticleViews à ajouter.
     * @return void
     */
    public function addArticleViews(ArticleViews $articleViews) : void
    {
        $sql = "INSERT INTO article_views (id_article) VALUES (:id_article)";
        $this->db->query($sql, [
            'id_article' => $articleViews->getIdArticle(),
        ]);
    }

    /**
     * Met à jour le nombre de vues d'un article.
     * On incrémente le nombre de vues de 1.
     * @param ArticleViews $articleViews : l'entité ArticleViews à mettre à jour.
     * @return void
     */
    public function updateArticleViews(ArticleViews $articleViews) : void
    {
        $sql = "UPDATE article_views SET view_count = view_count + 1 WHERE id_article = :id_article";
        $this->db->query($sql, [
            'id_article' => $articleViews->getIdArticle(),
        ]);
    }
}
