<?php
/**
 * Entité Monitoring, est une classe de composition des entités Article, ArticleViews et Comment.
 */
class Monitoring extends AbstractEntity
{
    private string $title;
    private DateTime $dateCreation;
    private int $articleViews;
    private int $comments;

    /**
     * Setter pour le titre.
     * @param string $title
     * @return void
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Setter pour la date de création.
     * @param string $dateCreation
     * @return void
     */
    public function setDateCreation(string $dateCreation) : void
    {
        $this->dateCreation = new DateTime($dateCreation);
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getDateCreation() : DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour le nombre de vues.
     * @param int $articleViews
     * @return void
     */
    public function setArticleViews(int $articleViews) : void
    {
        $this->articleViews = $articleViews;
    }

    /**
     * Getter pour le nombre de vues.
     * @return int
     */
    public function getArticleViews() : int
    {
        return $this->articleViews;
    }

    /**
     * Setter pour le nombre de commentaires.
     * @param int $comments
     * @return void
     */
    public function setComments(int $comments) : void
    {
        $this->comments = $comments;
    }

    /**
     * Getter pour le nombre de commentaires.
     * @return int
     */
    public function getComments() : int
    {
        return $this->comments;
    }

}