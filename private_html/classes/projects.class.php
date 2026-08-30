<?php

namespace OffTheGridCG;

use DateTime;
use OffTheGridCG\DB;

class project {
    public $id = null;
    public $name;
    public $title;
    public $description = null;
    public ?projectStatus $status = null;
    public $links = null;
    public $notes = null;
    public $dropReason = null;
    public ?DateTime $created = null;
    public ?DateTime $updated = null;

    public function __construct($id = null) {
        if ($id) {
            $sql = "SELECT * FROM `projects` WHERE id = :id";
            $params = [ 'id' => $id ];
            $result = DB::getInstance()->query($sql, $params, 1);
            if ($result) {
                $this->hydrate($result[0]);
            }
        }
    }

    private function hydrate(array $row): void {
        $this->id = (int) $row['id'];
        $this->name = $row['name'];
        $this->title = $row['title'];
        $this->description = $row['description'] ?? null;
        $this->status = $row['status'] !== null ? projectStatus::from($row['status']) : null;
        $this->links = $row['links'] !== null ? json_decode($row['links'], true) : null;
        $this->notes = $row['notes'] ?? null;
        $this->dropReason = $row['dropReason'] ?? null;
        $this->created = new DateTime($row['created']);
        $this->updated = new DateTime($row['updated']);
    }

    public function save(): bool {
        $db = DB::getInstance();
        $params = [
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status?->value,
            'links' => $this->links !== null ? json_encode($this->links) : null,
            'notes' => $this->notes,
            'dropReason' => $this->dropReason,
        ];

        if ($this->id) {
            $sql = "UPDATE `projects` SET name = :name, title = :title, description = :description,
                    status = :status, links = :links, notes = :notes, dropReason = :dropReason, updated = NOW()
                    WHERE id = :id";
            $params['id'] = $this->id;
            $result = $db->queryExec($sql, $params);
            if ($result === null) return false;
            $this->updated = new DateTime();
            return true;
        }

        $sql = "INSERT INTO `projects` (name, title, description, status, links, notes, dropReason, created, updated)
                VALUES (:name, :title, :description, :status, :links, :notes, :dropReason, NOW(), NOW())";
        $result = $db->queryExec($sql, $params);
        if ($result === null) return false;

        $this->id = (int) $db->lastInsertId();
        $this->created = new DateTime();
        $this->updated = new DateTime();
        return true;
    }
}

enum projectStatus: string {
    case Done = 'done';
    case OnHold = 'onhold';
    case Active = 'active';
    case Planning = 'planning';
    case Dropped = 'dropped';
}
