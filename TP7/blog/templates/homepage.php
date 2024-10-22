<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1>Bienvenue sur le blog de l'AVBN !</h1>

<?php foreach ($posts as $post) : ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post->title) ?>
            <em>le <?= $post->frenchCreationDate ?></em>
        </h3>

        <p><?= nl2br(htmlspecialchars($post->content)) ?></p>
        <a href="index.php?action=post&id=<?= $post->identifier ?>">Lire la suite</a>
    </div>
<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
