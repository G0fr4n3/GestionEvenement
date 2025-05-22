<?php
require_once '../../controllers/EventController.php';
$controller = new EventController();
$events = $controller->list();

include '../layout/header.php';
?>

<h2>Liste des événements</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Titre</th><th>Date</th><th>Description</th><th>Action</th>
    </tr>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $event['id'] ?></td>
            <td><?= htmlspecialchars($event['titre']) ?></td>
            <td><?= $event['date_evenement'] ?></td>
            <td><?= htmlspecialchars($event['description']) ?></td>
            <td>
                <a href="edit_event.php?id=<?= $event['id'] ?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../layout/footer.php'; ?>
