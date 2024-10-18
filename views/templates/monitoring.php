<?php 
    /** 
     * Affichage de la partie monitoring : liste des articles avec affichage du nombre de vues, de commentaires et la date de publication.
     */
?>

<nav class="secondaryNav" aria-label="Navigation secondaire" role="navigation">
    <a href="index.php?action=admin"><h2>Edition des articles</h2></a>
    <a href="index.php?action=monitoring"><h2>Monitoring</h2></a>
</nav>

<div class="adminArticle">
    <table class="monitoringTable">
        <thead>
            <tr>
                <th scope="col">Titre<br><i class="fa-solid fa-caret-up"></i></th>
                <th scope="col">Nombre de vues<br><i class="fa-solid fa-caret-up"></i></th>
                <th scope="col">Nombre de commentaires<br><i class="fa-solid fa-caret-up"></i></th>
                <th scope="col">Date de publication<br><i class="fa-solid fa-caret-up"></i></th>   
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td scope="row"><?= $article->getTitle() ?></td>
                    <td scope="row"><?= $viewCount ?></td>
                    <td scope="row"><?= $commentsCount ?></td>
                    <td scope="row"><?= $publicationDate ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>        
</div>