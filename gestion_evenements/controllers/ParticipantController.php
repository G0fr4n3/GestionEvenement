<?php
require_once __DIR__ . '/../models/ParticipantModel.php';

class ParticipantController {
    private $model;

    public function __construct() {
        $this->model = new ParticipantModel();
    }

    public function create($nom, $email) {
        if (empty($nom) || empty($email)) {
            return "Tous les champs sont requis.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email invalide.";
        }

        try {
            $this->model->create($nom, $email);
            return "Participant inscrit.";
        } catch (Exception $e) {
            return "Erreur lors de l'inscription.";
        }
    }

    public function list() {
        return $this->model->readAll();
    }
}
