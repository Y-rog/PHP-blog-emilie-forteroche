<?php 
    /** 
     * Affichage de la partie monitoring : liste des articles avec affichage du nombre de vues, de commentaires et la date de publication.
     */
?>

<nav class="secondaryNav" aria-label="Navigation secondaire" role="navigation">
    <a href="index.php?action=admin"><h2>Edition des articles</h2></a>
    <a href="index.php?action=monitoring"><h2>Monitoring</h2></a>
</nav>

<table class="monitoringTable">
    <thead>
        <tr>
            <th scope="col"><a href="<?= Utils::displaySortLink($title, $sort, $order)?>">Titre<br><i class="fa-solid <?= Utils::displayCaret($sort, $title, $order) ?>"></i></a></th>
            <th scope="col"><a href="<?= Utils::displaySortLink($articleViews, $sort, $order)?>">Nombre de vues<br><i class="fa-solid <?= Utils::displayCaret($sort, $articleViews, $order) ?>"></i></a></th>
            <th scope="col"><a href="<?= Utils::displaySortLink($comments, $sort, $order)?>">Nombre de commentaires<br><i class="fa-solid <?= Utils::displayCaret($sort, $comments, $order) ?>"></i></a></th>
            <th scope="col"><a href="<?= Utils::displaySortLink($dateCreation, $sort, $order)?>">Date de publication<br><i class="fa-solid <?= Utils::displayCaret($sort, $dateCreation, $order) ?>"></i></a></th>   
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <td scope="row"><?= htmlspecialchars($article->getTitle()) ?></td>
                <td scope="row"><?= htmlspecialchars($article->getArticleViews()) ?></td>
                <td scope="row"><?= htmlspecialchars($article->getComments()) ?></td>
                <td scope="row"><?= htmlspecialchars($article->getDateCreation()->format('d/m/Y')) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>        

