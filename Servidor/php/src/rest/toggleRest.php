<?php
require_once(__DIR__."/../model/Toggle.php");
require_once(__DIR__."/../model/ToggleMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

class ToggleRest extends BaseRest {
    private $toggleMapper;
    private $userMapper;

    public function __construct() {
        $this->toggleMapper = new ToggleMapper();
        $this->userMapper = new UserMapper();
    }

    function index(){
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

        $toggles = $this->toggleMapper->findAll($currentUserId);

        $toggle_array = array();

        foreach($toggles as $toggle) {
            array_push($toggle_array, array(
                "name" => $toggle->getToggleName(),
                "date" => $toggle->getTurnOnDate(),
                "description"=>$toggle->getDescription(),
                "state"=>$toggle->getState(),
                "id" =>$toggle->getPublicId()
            ));
        }
        
        // Transform toggle data to JSON
        header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
        header('Content-Type: application/json');
        echo json_encode($toggle_array);
    }

    function add($data) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

        if(!isset($data->name)) {
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            return;
        }

        $toggle = new Toggle();
        $toggle->setUserId( $currentUserId);
        $toggle->setPrivateId($this->generateUUID());
        $toggle->setPublicId($this->generateUUID());
        $toggle->setToggleName($data->name);
        $toggle->setState(filter_var($data->namestate, FILTER_VALIDATE_BOOLEAN));

        // Set the shutdown date if the state is 'on' and it's provided in the request
        if ($toggle->getState()) {
            $shutdownDate = !empty($data->shutdown_date) ? $data-shutdown_date : $toggle->defaultShutdownDate();
        } else {
            $shutdownDate = NULL;
        }

        $toggle->setShutdownDate($shutdownDate);
        $toggle->setDescription($data->description);

        try {
            $toggle->isValidToggle();
            $this->toggleMapper->save($toggle);

            // Return success response
            header($_SERVER['SERVER_PROTOCOL'] . ' 201 Created');
            echo json_encode(array('message' => 'Toggle successfully added'));
        } catch (ValidationException $ex) {
            // Return error response
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
        }
    }

    function delete($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);
        
        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }
        
        $toggle = $this->toggleMapper->getToggleById($toggle->getToggleId());

        if ($toggle['user_id'] !== $currentUserId) { 
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('message' => 'User cant delete toggle.'));
            return;
        }

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);
        $toggle->setUserId($currentUserId);

        $this->toggleMapper->delete($toggle);
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        echo json_encode(array('message' => 'Successful delete.'));
    }

    function subscribed() {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

		$suscribedToggles = $this->toggleMapper->findSuscribed($currentUserId);
        
        $toggles = array();
        foreach($suscribedToggles as $toggle) {
            array_push($toggles, array(
				"toggle_name" => $toggle->getToggleName(),
                "public_id" => $toggle->getPublicId(),
                "state" => $toggle->getState(),
                "shutdown_date" => $toggle->getShutdownDate(),
                "toggle_description" => $toggle->getDescription(),
                "toggle_id" => $toggle->getToggleId(),
                "username" => $toggle->getUsername()
			));
        }


        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        header('Content-Type: application/json');
		echo(json_encode($toggles));

    }

    function getInformation($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);

        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }

        $toggle = $this->toggleMapper->getToggleById($toggle->getToggleId());

        $response = array(
            "toggle_name" => $toggle['toggle_name'],
            "toggle_state" => $toggle['toggle_state'],
            "turn_on_date" => $toggle['turn_on_date'],
            "toggle_description" => $toggle['toggle_description'],
            "public_id" => $toggle['public_id']
        );

        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        header('Content-Type: application/json');
		echo(json_encode($response));
    }

    private function generateUUID(){
        return trim(file_get_contents('/proc/sys/kernel/random/uuid'));
    }

    function onLink($toggleURI) {
        $isPublic = $this->toggleMapper->isUriPublic($toggleURI);

        if($isPublic) { 
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request.');
            return;
        }

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);
    
        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }
        
        $toggle->setState(true);
        $toggle->setShutdownDate($toggle->defaultShutdownDate());

        $this->toggleMapper->turnOnUser($toggle);
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        echo json_encode(array('message' => 'Toggle successfully turned on.'));
    }

    function onUser($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());
        
        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);

        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }

        $toggle = $this->toggleMapper->getToggleById($toggle->getToggleId());
        
        if($toggle['user_id'] != $currentUserId) { 
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request.');
            return;
        }

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggle['public_id']);

        $toggle->setState(true);
        $toggle->setShutdownDate($toggle->defaultShutdownDate());

        $this->toggleMapper->turnOnUser($toggle);
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        echo json_encode(array('message' => 'Toggle successfully turned on.'));
    }

    function offUser($toggleURI) {
        $currentUser = parent::authenticateUser();
        $currentUserId = $this->userMapper->getUserIdByUsername($currentUser->getUsername());
        
        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);
        
        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }
        
        $toggle = $this->toggleMapper->getToggleById($toggle->getToggleId());

        if($toggle['user_id'] != $currentUserId) { 
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request.');
            return;
        }
        
        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggle['public_id']);

        $toggle->setState(false);

        $this->toggleMapper->turnOffUser($toggle);
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        echo json_encode(array('message' => 'Toggle successfully turned off.'));
    }

    function offLink($toggleURI) {
        $isPublic = $this->toggleMapper->isUriPublic($toggleURI);


        if($isPublic) { 
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request.');
            return;
        }

        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);
    
        if($toggle == NULL) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found.');
            return;
        }
        
        $toggle->setState(false);

        $this->toggleMapper->turnOffLink($toggle);
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        echo json_encode(array('message' => 'Toggle successfully turned off'));
    }

}


// URI-MAPPING for this Rest endpoint
$toggleRest = new ToggleRest();
URIDispatcher::getInstance()
->map("GET",	"/toggle", array($toggleRest,"index"))
->map("GET",	"/subscribed", array($toggleRest,"subscribed"))
->map("GET",	"/toggle/$1", array($toggleRest,"getInformation"))
->map("POST",   "/toggle", array($toggleRest,"add"))
->map("PUT",	"/onLink/$1", array($toggleRest,"onLink"))
->map("PUT",	"/offLink/$1", array($toggleRest,"offLink"))
->map("PUT",	"/onUser/$1", array($toggleRest,"onUser"))
->map("PUT",	"/offUser/$1", array($toggleRest,"offUser"))
->map("DELETE", "/toggle/$1", array($toggleRest,"delete"));