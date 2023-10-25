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

		$this->view->setLayout("welcome");
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
           
            //$this->view->redirect("toggle", "view");

        } catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            print_r($ex);
        }
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

    private function getCurrentUserId() {
        return 1;
    }
}   