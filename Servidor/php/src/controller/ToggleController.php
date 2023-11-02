<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Toggle.php");
require_once(__DIR__."/../model/ToggleMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ToggleController extends BaseController {
    private $toggleMapper;

    public function __construct() {
		parent::__construct();

		$this->toggleMapper = new ToggleMapper();

		$this->view->setLayout("auth");
	}

    public function view() {
        $this->view->render("dashboard", "dashboard");
    }

    /**
	* Action to list posts
	*
	* Loads all the posts from the database.
	* No HTTP parameters are needed.
	*
	* The views are:
	* <ul>
	* <li>posts/index (via include)</li>
	* </ul>
	*/
	public function index() {

        // Obtain UserID
        $userID = $this->getCurrentUserId();
       

		$toggles = $this->toggleMapper->findAll($userID);

		// put the array containing Post object to the view
		$this->view->setVariable("toggles", $toggles);

		// render the view (/view/dashboard/dashboard.php)
		$this->view->render("dashboard", "dashboard");
	}

    public function suscribed() {
        // Obtain UserID
        $userID = $this->getCurrentUserId();

		$suscribedToggles = $this->toggleMapper->findSuscribed($userID);

		// put the array containing Post object to the view
		$this->view->setVariable("suscribedToggles", $suscribedToggles);

		// render the view (/view/dashboard/dashboard.php)
		$this->view->render("dashboard", "suscritos");
    }

    public function add() {
        if (!$this->checkSession()){
		   return;
		}
        
        $toggle = new Toggle();

        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setPrivateId($this->generateUUID());
        $toggle->setPublicId($this->generateUUID());
        $toggle->setToggleName($_POST["name"]);
        $toggle->setState(filter_var($_POST['state'], FILTER_VALIDATE_BOOLEAN));
        $toggle->setShutdownDate(
            $toggle->getState() ? $_POST['shutdown_date'] : NULL
        );
        $toggle->setDescription($_POST['description']);


        try {
            $toggle->isValidToggle();
            
            $this->toggleMapper->save($toggle);

            $this->view->setFlash("Toggle ". $toggle_name ." successfully added.");

        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }

        $this->view->redirect("toggle", "index");
    }

    private function generateUUID(){
        return trim(file_get_contents('/proc/sys/kernel/random/uuid'));
    }

    public function onUser(){
        if (!$this->checkSession()) return;

        $toggle = new Toggle();

        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setShutdownDate(
            isset($_POST['shutdown_date']) ? $_POST['shutdown_date'] : $toggle->defaultShutdownDate()
        );
        $toggle->setState(true);
        $toggle->setToggleId($_POST['id']);
        $toggle->setTurnOnDate($this->getActualDateTime());

        try{
            $toggle->canTurnOn();
            $this->toggleMapper->turnOnUser($toggle);
        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }
    }

    private function getActualDateTime(){
        $dateTime = new DateTime();
        return $dateTime->format('Y-m-d H:i:s');
    }

    public function onLink(){
        $toggle = new Toggle();

        $toggle->setPrivateId($_POST['private_id']);
        $toggle->setShutdownDate(
            isset($_POST['shutdown_date']) ? $_POST['shutdown_date'] : $this->defaultShutdownDate()
        );
        $toggle->setState(true);
        $toggle->setTurnOnDate($this->getActualDateTime());

        try{
            $toggle->canTurnOn();
            $this->toggleMapper->turnOnLink($toggle);
        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }
    }

    public function offUser(){
        if (!$this->checkSession()) return;

        $toggle = new Toggle();

        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setState(false);
        $toggle->setToggleId($_POST['id']);
        $toggle->setShutdownDate(NULL);
        try{
            $toggle->canTurnOff();
            $this->toggleMapper->turnOffUser($toggle);
        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }
    }

    
    public function offLink(){
        $toggle = new Toggle();

        $toggle->setPrivateId($_POST['private_id']);
        $toggle->setShutdownDate(NULL);
        $toggle->setState(false);

        try{
            $toggle->canTurnOff();
            $this->toggleMapper->turnOffLink($toggle);
        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }
    }

    public function delete(){
        if (!$this->checkSession()) return;

        $toggle = new Toggle();

        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setToggleId($_POST['id']);
        try{
            $this->toggleMapper->delete($toggle);
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

    public function getCurrentUserId() {
		session_start();
        
		if (isset($_SESSION["user_id"])) {
			return $_SESSION["user_id"];
		} else {
			return 0;
		}
	}
}   