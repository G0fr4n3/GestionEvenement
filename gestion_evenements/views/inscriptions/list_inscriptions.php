<?php
require_once '../../controllers/InscriptionController.php';
$controller = new InscriptionController();
$inscriptions = $controller->list();

include '../layout/header.php';
?>

<h2>Liste des inscriptions</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Événement</th><th>Participant</th><th>Date d'inscription</th>
    </tr>
    <?php foreach ($inscriptions as $ins): ?>
        <tr>
            <td><?= $ins['id'] ?></td>
            <td><?= $ins['event_id'] ?></td>
            <td><?= $ins['participant_id'] ?></td>
            <td><?= $ins['date_inscription'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../layout/footer.php'; ?>
