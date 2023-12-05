<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SubscriptionMapper {
    private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

    public function subscribe($toggleId, $currentUserId) {
        $stmt = $this->db->prepare("INSERT INTO subscriptions (user_id, toggle_id) VALUES (:currentUserId, :toggleId)");

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }

    
    public function unsubscribe($toggleId, $currentUserId) {
        $stmt = $this->db->prepare("DELETE FROM subscriptions WHERE user_id = :currentUserId AND toggle_id = :toggleId");

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }
}