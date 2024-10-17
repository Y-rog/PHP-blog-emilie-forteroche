<?php

/**
 * Entité ArticleViews, un article est défini par les champs
 * id, view_count, article_id
 */
class ArticleViews extends AbstractEntity
{
    private int $id_article;
    private int $view_count;
    /**
     * Setter pour l'id de l'article.
     * @param int $article_id
     * @return void
     */
    public function setIdArticle(int $id_article) : void
    {
        $this->id_article = $id_article;
    }

    /**
     * Getter pour l'id de l'article.
     * @return int
     */
    public function getIdArticle() : int
    {
        return $this->id_article;
    }

    /**
     * Setter pour le nombre de vues.
     * @param int $view_count
     * @return void
     */
    public function setViewCount(int $view_count) : void
    {
        $this->view_count = $view_count;
    }

    /**
     * Getter pour le nombre de vues.
     * @return int
     */
    public function getViewCount() : int
    {
        return $this->view_count;
    }

}
 
