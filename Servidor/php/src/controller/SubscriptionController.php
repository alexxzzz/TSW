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

        /**
 * Action to delete a toggle
 */
public function unsubscribe() {
    // Check if the user is logged in
    if (!$this->checkSession()) {
        throw new Exception("Not in session. Deleting toggles requires login");
    }

    // Get the current user from the session or your authentication system
    $currentUserId = $_SESSION['user_id']; // Adjust this based on your actual session structure

    // Get the ID of the toggle to be deleted
    $toggleId = (int)$_GET["id"];
    
    // Check if a valid toggle ID was provided
    if (!$toggleId) {
        throw new Exception("Invalid toggle ID provided");
    }

    // Get the Toggle object from the database
    $toggle = $this->subscriptionMapper->getToggleById($toggleId); // Adjust based on your data retrieval method

    if (!$toggle) {
        throw new Exception("No such toggle with ID: " . $toggleId);
    }

    // Delete the Toggle object from the database
    $this->subscriptionMapper->unsubscribe($toggleId, $currentUserId);

    // After deleting the toggle, you can redirect to a suitable location.
    $this->view->redirect("toggle", "suscribed");
}



    /*
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
    */

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