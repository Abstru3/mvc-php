<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Le blog de l'AVBN</title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>
        <?php $title = "Le blog de l'AVBN"; ?>
        <?php ob_start(); ?>
            <h1>Le super blog de l'AVBN !</h1>
            <p>Derniers billets du blog :</p>
        <?php
            foreach ($posts as $post) {
            ?>
            <div class="news">
                <h3>
                <?= htmlspecialchars($post['title']); ?>
                <em>le <?= $post['frenchCreationDate']; ?> </em>
                </h3>
                <p>
                <?= nl2br(htmlspecialchars($post['content'])); ?>
                <br />
                <em>
 HEAD
                <a href="index.php?action=post&id=<?= urlencode($post['identifier']) ?> "> Commentaires

                <a href="post.php?id=<?= urlencode($post['identifier']) ?> ">
                Commentaires
 1e7d5234d0d7d6f83326626b8c31af3a5e09b2dc
                </a></em>
                </p>
            </div>
            <?php
            }
            ?>
        <?php $content = ob_get_clean(); ?>
        <?php require('layout.php') ?>
        
    </body>
</html>
