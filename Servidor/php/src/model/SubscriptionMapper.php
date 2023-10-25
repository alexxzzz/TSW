<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SubscriptionMapper {
    private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

    public function subscribe($subscription) {
        $user_id = $subscription->getUserId();
        $toggle_id = $subscription->getToggleId();

        $stmt = $this->db->prepare("INSERT INTO subscriptions (user_id, toggle_id) VALUES (?, ?)");

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }

    public function unsubscribe($subscription) {
        $user_id = $subscription->getUserId();
        $toggle_id = $subscription->getToggleId();

        $stmt = $this->db->prepare("DELETE FROM subscriptions WHERE user_id = ? AND toggle_id = ?");

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }
}