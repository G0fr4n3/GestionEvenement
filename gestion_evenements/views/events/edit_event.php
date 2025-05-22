<?php
require_once '../../controllers/EventController.php';
require_once '../../models/EventModel.php';

$controller = new EventController();
$model = new EventModel();
$message = "";
$event = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $event = $model->readById($id);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $controller->update($_POST['id'], $_POST['titre'], $_POST['date_evenement'], $_POST['description']);
    $event = $model->readById($_POST['id']);
}

include '../layout/header.php';
?>

<h2>Modifier un événement</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if ($event): ?>
<form method="post">
    <input type="hidden" name="id" value="<?= $event['id'] ?>">
    <label>Titre:</label><br>
    <input type="text" name="titre" value="<?= $event['titre'] ?>"><br>
    <label>Date:</label><br>
    <input type="date" name="date_evenement" value="<?= $event['date_evenement'] ?>"><br>
    <label>Description:</label><br>
    <textarea name="description"><?= $event['description'] ?></textarea><br>
    <input type="submit" value="Mettre à jour">
</form>
<?php else: ?>
    <p>Événement non trouvé.</p>
<?php endif; ?>

<?php include '../layout/footer.php'; ?>
