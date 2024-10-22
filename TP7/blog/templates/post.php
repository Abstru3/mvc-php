<?php $title = "Le blog de l'AVBN"; ?>
<?php ob_start(); ?>
<h1>Le super blog de l'AVBN !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post->title) ?>
        <em>le <?= $post->frenchCreationDate ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post->content)) ?>
    </p>
</div>

<h2>Commentaires</h2> 

<form action="index.php?action=addComment&id=<?= $post->identifier ?>" method="post">
   <div>
      <label for="author">Auteur</label><br />
      <input type="text" id="author" name="author" required />
   </div>
   <div>
      <label for="comment">Commentaire</label><br />
      <textarea id="comment" name="comment" required></textarea>
   </div>
   <div>
      <input type="submit" />
   </div>
</form>

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment) : ?>
    <div class="comment">
        <h4><?= htmlspecialchars($comment->author) ?> <em>le <?= $comment->frenchCreationDate ?></em></h4>
        <p><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
    </div>
<?php endforeach; ?>

<?php else: ?>
    <p>Aucun commentaire n'a encore été ajouté.</p>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
