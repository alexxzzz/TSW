<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Subscription.php");
require_once(__DIR__."/../model/SubscriptionMapper.php");

require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/ToggleMapper.php");

require_once(__DIR__."/../util/util.php");

class SubscriptionRest extends BaseRest {    
    private $subscriptionMapper;
    private $userMapper;
    private $toggleMapper;

    public function __construct() {
        $this->subscriptionMapper = new SubscriptionMapper();
        $this->userMapper = new UserMapper();
        $this->toggleMapper = new ToggleMapper();
    }

    public function subscribe($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());
        
        if(!isUuidValid($toggleURI)) {
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }
        
        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);

        if($toggle == NULL){ 
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        try {
            $id = $toggle->getToggleId();
            $this->subscriptionMapper->subscribe($id, $currentUserId);
            // Return HTTP status 201
            header($_SERVER['SERVER_PROTOCOL'].' 201 Created');


        } catch (ValidationException $ex) {
            $errors = $ex->getErrors();
            // Handle validation errors, perhaps return a specific HTTP status code
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
        }
        
       
    }

    public function unsubscribe($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

        if(!isUuidValid($toggleURI)) {
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);

        if($toggle == NULL){ 
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        try {
            $this->subscriptionMapper->unsubscribe($toggle->getToggleId(), $currentUserId);
            // Return HTTP status 201            
            header($_SERVER['SERVER_PROTOCOL'].' 201 Created');


        } catch (ValidationException $ex) {
            $errors = $ex->getErrors();
            // Handle validation errors, perhaps return a specific HTTP status code
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
        }
    }

}

// URI-MAPPING for this Rest endpoint
$toggleRest = new SubscriptionRest();
URIDispatcher::getInstance()
->map("POST",	"/subscription/$1", array($toggleRest,"subscribe"))
->map("DELETE",	"/subscription/$1", array($toggleRest,"unsubscribe"));

