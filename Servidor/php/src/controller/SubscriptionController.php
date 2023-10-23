<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Subscription.php");
require_once(__DIR__."/../model/SubscriptionMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class SubscriptionController extends BaseController {
    private $subscriptionMapper;

    public function __construct() {
		parent::__construct();

		$this->subscriptionMapper = new SubscriptionMapper();

		$this->view->setLayout("welcome");
	}

    public function subscribe(){
        if (!$this->checkSession()){
            return;
         }
         
         $subscription = new Subscription();
 
         $subscription->setUserId($this->getCurrentUserId());
         $subscription->setToggleId($_POST['toggle_id']);
 
         try {  
             $this->subscriptionMapper->subscribe($subscription);
 
             $this->view->setFlash("Subscription successfully added.");
            
             //$this->view->redirect("toggle", "view");
 
         } catch(ValidationException $ex) {
             $errors = $ex->getErrors();
             print_r($ex);
         }
    }

    public function unsubscribe(){
        if (!$this->checkSession()){
            return;
         }
         
         $subscription = new Subscription();
 
         $subscription->setUserId($this->getCurrentUserId());
         $subscription->setToggleId($_POST['toggle_id']);
 
         try {  
             $this->subscriptionMapper->unsubscribe($subscription);
 
             $this->view->setFlash("Subscription successfully removed.");
            
             //$this->view->redirect("toggle", "view");
 
         } catch(ValidationException $ex) {
             $errors = $ex->getErrors();
             print_r($ex);
         }
    }

    private function checkSession(){
        /*if (!isset($_SESSION["user_id"])){
		    $this->view->render("users", "login");
            return false;
		}*/
        return true;
    }

    private function getCurrentUserId() {
        return 2;
    }
}