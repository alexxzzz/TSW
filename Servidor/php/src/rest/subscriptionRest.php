<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Subscription.php");
require_once(__DIR__."/../model/SubscriptionMapper.php");

require_once(__DIR__."/../model/UserMapper.php");

class SubscriptionRest extends BaseRest {    
    private $subscriptionMapper;
    private $userMapper;

    public function __construct() {
        $this->subscriptionMapper = new SubscriptionMapper();
        $this->userMapper = new UserMapper();
    }

    public function subscribe($toggleId) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());
        
        $toogle = $this->subscriptionMapper->getToggleById($toggleId);

        if($toogle == NULL){ 
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        try {
            $this->subscriptionMapper->subscribe($toggleId, $currentUserId);
            // Return HTTP status 201
            header($_SERVER['SERVER_PROTOCOL'].' 201 Created');


        } catch (ValidationException $ex) {
            $errors = $ex->getErrors();
            // Handle validation errors, perhaps return a specific HTTP status code
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
        }
        
       
    }

    public function unsubscribe($toggleId) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());
        
        $toogle = $this->subscriptionMapper->getToggleById($toggleId);

        if($toogle == NULL){ 
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        try {
            $this->subscriptionMapper->unsubscribe($toggleId, $currentUserId);
            // Return HTTP status 201            
            header($_SERVER['SERVER_PROTOCOL'].' 201 Created');


        } catch (ValidationException $ex) {
            $errors = $ex->getErrors();
            // Handle validation errors, perhaps return a specific HTTP status code
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
        }
    }

    private function checkSession($currentUserId) {
        // Perform your session checks based on $currentUserId
        // Return true if the session is valid; otherwise, return false
        return isset($currentUserId);
    }
}

// URI-MAPPING for this Rest endpoint
$toggleRest = new SubscriptionRest();
URIDispatcher::getInstance()
->map("PUT",	"/subscribe/$1", array($toggleRest,"subscribe"))
->map("PUT",	"/unsubscribe/$1", array($toggleRest,"unsubscribe"));

