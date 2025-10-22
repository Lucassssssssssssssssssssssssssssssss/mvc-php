<?php $title = "Modifier un commentaire"; ?>

<?php ob_start(); ?>
<h1>Modifier le commentaire</h1>

<form action="index.php?action=updateComment&id=<?= $comment->id ?>&post_id=<?= $postId ?>" method="post">
   <div>
      <label for="author">Auteur</label><br />
      <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment->author) ?>" />
   </div>
   <div>
      <label for="comment">Commentaire</label><br />
      <textarea id="comment" name="comment"><?= htmlspecialchars($comment->comment) ?></textarea>
   </div>
   <div>
      <input type="submit" value="Mettre à jour" />
   </div>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>