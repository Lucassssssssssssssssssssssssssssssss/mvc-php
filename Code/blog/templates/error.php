<?php
    $title = 'Une erreur est survenue';
    
    ob_start();
?>

<h1>Oups…</h1>
<p>Une erreur s’est produite lors du traitement de votre demande.</p>

<?php if (isset($errorMessage) && $errorMessage !== ''): ?>
  <p><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<p>
  <a href="index.php">Retour à l’accueil</a>
  <?php if (isset($_GET['id']) && ctype_digit((string)$_GET['id'])): ?>
    | <a href="index.php?action=post&id=<?= urlencode($_GET['id']) ?>">Retour au billet</a>
  <?php endif; ?>
</p>

<?php
$content = ob_get_clean();

require 'templates/layout.php';
