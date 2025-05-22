<?php
require_once __DIR__ . '/../models/EventModel.php';

class EventController {
    private $model;

    public function __construct() {
        $this->model = new EventModel();
    }

    public function create($titre, $date, $description) {
        if (empty($titre) || empty($date)) {
            return "Titre et date sont obligatoires.";
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return "Format de date invalide (AAAA-MM-JJ).";
        }

        try {
            $this->model->create($titre, $date, $description);
            return "Événement créé avec succès.";
        } catch (Exception $e) {
            return "Erreur lors de la création de l'événement.";
        }
    }

    public function update($id, $titre, $date, $description) {
        if (empty($titre) || empty($date)) {
            return "Titre et date sont obligatoires.";
        }

        try {
            $this->model->update($id, $titre, $date, $description);
            return "Événement mis à jour.";
        } catch (Exception $e) {
            return "Erreur lors de la mise à jour.";
        }
    }

    public function list() {
        return $this->model->readAll();
    }

    public function get($id) {
        return $this->model->readById($id);
    }
}
