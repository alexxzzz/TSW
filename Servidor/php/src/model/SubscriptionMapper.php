<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SubscriptionMapper {
    private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

<<<<<<< Updated upstream
    public function subscribe($subscription) {
        $user_id = $subscription->getUserId();
        $toggle_id = $subscription->getToggleId();

        $stmt = $this->db->prepare("INSERT INTO subscriptions (user_id, toggle_id) VALUES (?, ?)");
=======
    public function subscribe($toggleId, $currentUserId) {
        $stmt = $this->db->prepare("INSERT INTO subscriptions (user_id, toggle_id) VALUES (:currentUserId, :toggleId)");
>>>>>>> Stashed changes

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }

<<<<<<< Updated upstream
    public function unsubscribe($subscription) {
        $user_id = $subscription->getUserId();
        $toggle_id = $subscription->getToggleId();

        $stmt = $this->db->prepare("DELETE FROM subscriptions WHERE user_id = ? AND toggle_id = ?");
=======
    
    public function unsubscribe($toggleId, $currentUserId) {
        $stmt = $this->db->prepare("DELETE FROM subscriptions WHERE user_id = :currentUserId AND toggle_id = :toggleId");
>>>>>>> Stashed changes

        if ($stmt->execute([$user_id, $toggle_id])) {
            return true;
        } else {
            return false;
        }
    }
}