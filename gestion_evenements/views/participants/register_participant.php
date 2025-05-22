<?php
require_once '../../controllers/ParticipantController.php';
require_once '../../controllers/InscriptionController.php';
require_once '../../models/EventModel.php';

$message = "";

$eventModel = new EventModel();
$events = $eventModel->getAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $participantController = new ParticipantController();
    $inscriptionController = new InscriptionController();

    // Créer le participant
    $participantId = $participantController->create($_POST['nom'], $_POST['email']);

    // Inscrire à un événement
    if ($participantId) {
        $success = $inscriptionController->inscrire($participantId, $_POST['event_id']);
        if ($success) {
            $message = "Participant inscrit avec succès !";
        } else {
            $message = "Erreur lors de l'inscription à l'événement.";
        }
    } else {
        $message = "Erreur lors de la création du participant.";
    }
}

include '../layout/header.php';
?>

<h2>Inscrire un participant</h2>

<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nom:</label><br>
    <input type="text" name="nom" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Événement:</label><br>
    <select name="event_id" required>
        <option value="">-- Choisir un événement --</option>
        <?php foreach ($events as $event): ?>
            <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['titre']) ?> (<?= $event['date_evenement'] ?>)</option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Inscrire">
</form>

<?php include '../layout/footer.php'; ?>
