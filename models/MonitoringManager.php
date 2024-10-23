<?php

/**
 * Classe qui gère le nombre de vues des articles.
 */
class MonitoringManager extends AbstractEntityManager
{
/**
     * Récupère tous les articles avec le nombre de vues et de commentaires.
     * @return array : un tableau d'objets Monitoring.
     */
    public function getAllArticlesWithViewsAndComments() : array
    {
        $sql = "SELECT article.id, article.title, article.date_creation, article_views.view_count AS article_views, COUNT(DISTINCT comment.id) AS comments 
                FROM article 
                LEFT JOIN article_views ON article.id = article_views.id_article 
                LEFT JOIN comment ON article.id = comment.id_article 
                GROUP BY article.id";
        $result = $this->db->query($sql);
        $monitoring = [];
        while ($monitoringData = $result->fetch()) {
            $monitoring[] = new Monitoring($monitoringData);
        }
        return $monitoring;
    }      
}