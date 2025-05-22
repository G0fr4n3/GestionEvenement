<?php
require_once __DIR__ . '/../models/InscriptionModel.php';

class InscriptionController {
    private $model;

    public function __construct() {
        $this->model = new InscriptionModel();
    }

    public function register($event_id, $participant_id) {
        // Vérification des champs
        if (empty($event_id) || empty($participant_id)) {
            return "Tous les champs sont requis.";
        }

        // Validation des ID
        if (!filter_var($event_id, FILTER_VALIDATE_INT) || !filter_var($participant_id, FILTER_VALIDATE_INT)) {
            return "IDs invalides.";
        }

        try {
            $success = $this->model->addInscription($event_id, $participant_id);

            if ($success) {
                return "Inscription réussie.";
            } else {
                return "Erreur lors de l'enregistrement.";
            }
        } catch (PDOException $e) {
            // Journaliser l’erreur réelle au lieu de l'afficher
            error_log("Erreur inscription: " . $e->getMessage());
            return "Une erreur s'est produite pendant l'inscription.";
        }
    }

    public function list() {
        try {
            return $this->model->readAll();
        } catch (PDOException $e) {
            error_log("Erreur récupération inscriptions: " . $e->getMessage());
            return [];
        }
    }

    public function inscrire($participantId, $eventId) {
        try {
            $model = new InscriptionModel();
            return $model->create($participantId, $eventId);
    }   catch (Exception $e) {
        return false;
    }
}

}
