<?php
require_once '../../controllers/EventController.php';
require_once '../layout/header.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'] ?? '';
    $date = $_POST['date_evenement'] ?? '';
    $description = $_POST['description'] ?? '';

    $controller = new EventController();
    $message = $controller->create($titre, $date, $description);
}
?>

<h2>Créer un Événement</h2>
<form method="POST" action="">
    <label>Titre:</label><br>
    <input type="text" name="titre" required><br><br>

    <label>Date de l'événement:</label><br>
    <input type="date" name="date_evenement" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Créer</button>
</form>

<p><?= $message ?></p>

<?php require_once '../layout/footer.php'; ?>
