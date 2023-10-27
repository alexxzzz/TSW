<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ToggleMapper {
    private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

    public function save($toggle) {
        $query = "INSERT INTO toggles (public_id, private_id, toggle_name, toggle_state, shutdown_date, user_id, toggle_description) 
                  VALUES (:public_id, :private_id, :toggle_name, :toggle_state, :shutdown_date, :user_id, :toggle_description)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':public_id', $toggle->getPublicId(), PDO::PARAM_STR);
        $stmt->bindParam(':private_id', $toggle->getPrivateId(), PDO::PARAM_STR);
        $stmt->bindParam(':toggle_name', $toggle->getToggleName(), PDO::PARAM_STR);
        $stmt->bindParam(':toggle_state', $toggle->getState(), PDO::PARAM_BOOL);
        $stmt->bindParam(':shutdown_date', $toggle->getShutdownDate());
        $stmt->bindParam(':user_id', $toggle->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(':toggle_description', $toggle->getDescription(), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findAll() {
        $query = "SELECT * FROM toggles, users WHERE toggles.user_id = users.user_id; ";
        $stmt = $this->db->query($query);
        $toggles_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$toggles = array();

		foreach ($toggles_db as $toggle_db) {
            $toggle = new Toggle();
            $toggle->setToggleName($toggle_db["toggle_name"]);
            $toggle->setState($toggle_db["toggle_state"]);
            $toggle->setShutdownDate($toggle_db["shutdown_date"]);
            $toggle->setUsername($toggle_db["username"]);
            $toggle->setDescription($toggle_db["toggle_description"]);
            array_push($toggles, $toggle);
		}

		return $toggles;
    }

    public function turnOnUser($toggle) {
        $query = "UPDATE toggles
            SET toggle_state = :toggle_state, shutdown_date = :shutdown_date, turn_on_date = :turn_on_date
            WHERE toggle_id = :toggle_id AND user_id = :user_id; ";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':toggle_id', $toggle->getToggleId(), PDO::PARAM_INT);
        $stmt->bindParam(':toggle_state', $toggle->getState(), PDO::PARAM_BOOL);
        $stmt->bindParam(':shutdown_date', $toggle->getShutdownDate());
        $stmt->bindParam(':user_id', $toggle->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(':turn_on_date', $toggle->getTurnOnDate());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function turnOffUser($toggle) {
        $query = "UPDATE toggles
            SET toggle_state = :toggle_state, shutdown_date = :shutdown_date
            WHERE toggle_id = :toggle_id AND user_id = :user_id; ";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':toggle_id', $toggle->getToggleId(), PDO::PARAM_INT);
        $stmt->bindParam(':toggle_state', $toggle->getState(), PDO::PARAM_BOOL);
        $stmt->bindParam(':shutdown_date', $toggle->getShutdownDate());
        $stmt->bindParam(':user_id', $toggle->getUserId(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function turnOnLink($toggle) {
        $query = "UPDATE toggles
            SET toggle_state = :toggle_state, shutdown_date = :shutdown_date, turn_on_date = :turn_on_date
            WHERE private_id = :private_id; ";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':toggle_state', $toggle->getState(), PDO::PARAM_BOOL);
        $stmt->bindParam(':shutdown_date', $toggle->getShutdownDate());
        $stmt->bindParam(':private_id', $toggle->getPrivateId(), PDO::PARAM_STR);
        $stmt->bindParam(':turn_on_date', $toggle->getTurnOnDate());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function turnOffLink($toggle) {
        $query = "UPDATE toggles
            SET toggle_state = :toggle_state, shutdown_date = :shutdown_date
            WHERE private_id = :private_id; ";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':toggle_state', $toggle->getState(), PDO::PARAM_BOOL);
        $stmt->bindParam(':shutdown_date', $toggle->getShutdownDate());
        $stmt->bindParam(':private_id', $toggle->getPrivateId(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($toggle) {
        $query = "DELETE FROM toggles
            WHERE toggle_id = :toggle_id AND user_id = :user_id; ";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':toggle_id', $toggle->getToggleId(), PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $toggle->getUserId(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



}