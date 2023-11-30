<?php
require_once(__DIR__."/../model/Toggle.php");
require_once(__DIR__."/../model/ToggleMapper.php");

class ToggleController {
    private $toggleMapper;

    public function __construct() {
        $this->toggleMapper = new ToggleMapper();
    }

    public function index() {
        $userID = $this->getCurrentUserId();
        $toggles = $this->toggleMapper->findAll($userID);

        // Transform the toggle data to JSON
        header('Content-Type: application/json');
        echo json_encode($toggles);
    }

    public function suscribed() {
        $userID = $this->getCurrentUserId();
        $suscribedToggles = $this->toggleMapper->findSuscribed($userID);

        // Transform the suscribed toggle data to JSON
        header('Content-Type: application/json');
        echo json_encode($suscribedToggles);
    }

    public function toggleInformation() {
        if (!isset($_GET["uri"])) {
            // Handle the case when URI is missing
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => 'URI is mandatory'));
            return;
        }

        $toggleURI = $_GET["uri"];
        $toggle = $this->toggleMapper->findByPublicOrPrivateURI($toggleURI);

        if ($toggle == NULL) {
            // Handle the case when no toggle is found
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo json_encode(array('error' => 'No switch found with the given URI'));
            return;
        }

        // Transform the toggle information to JSON
        header('Content-Type: application/json');
        echo json_encode($toggle);
    }

    public function add() {
        // Assuming data is sent via POST request in JSON format
        $data = json_decode(file_get_contents('php://input'), true);

        // Instantiate Toggle object and set its properties using $data
        
        $toggle = new Toggle();
        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setPrivateId($this->generateUUID());
        $toggle->setPublicId($this->generateUUID());
        $toggle->setToggleName($data["name"]);
        $toggle->setState(filter_var($data['state'], FILTER_VALIDATE_BOOLEAN));

        // Set the shutdown date if the state is 'on' and it's provided in the request
        if ($toggle->getState()) {
            $shutdownDate = !empty($data['shutdown_date']) ? $data['shutdown_date'] : $toggle->defaultShutdownDate();
        } else {
            $shutdownDate = NULL;
        }

        $toggle->setShutdownDate($shutdownDate);
        $toggle->setDescription($data['description']);

        try {
            $toggle->isValidToggle();
            $this->toggleMapper->save($toggle);

            // Return success response
            header($_SERVER['SERVER_PROTOCOL'] . ' 201 Created');
            echo json_encode(array('message' => 'Toggle successfully added'));
        } catch (ValidationException $ex) {
            // Return error response
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => $ex->getMessage()));
        }
    }

    private function generateUUID(){
        return trim(file_get_contents('/proc/sys/kernel/random/uuid'));
    }

    public function onUser() {
        // Assuming data is sent via POST request in JSON format
        $data = json_decode(file_get_contents('php://input'), true);

        // Instantiate Toggle object and set its properties using $data
        $toggle = new Toggle();
        $toggle->setUserId($this->getCurrentUserId());
        $toggle->setShutdownDate(
            !empty($data['shutdown_date']) ? $data['shutdown_date'] : $toggle->defaultShutdownDate()
        );
        $toggle->setState(true);
        $toggle->setToggleId($data['id']);
        $toggle->setTurnOnDate($this->getActualDateTime());

        try {
            $toggle->canTurnOn();
            $this->toggleMapper->turnOnUser($toggle);

            // Return success response
            header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
            echo json_encode(array('message' => 'Toggle turned on successfully'));
        } catch (ValidationException $ex) {
            // Return error response
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => $ex->getMessage()));
        }
    }

    public function onLink() {
        // Assuming data is sent via POST request in JSON format
        $data = json_decode(file_get_contents('php://input'), true);

        // Retrieve public URI from the request data
        $publicUri = isset($data['uri']) ? $data['uri'] : null;

        if ($publicUri) {
            $isPublic = $this->toggleMapper->isUriPublic($publicUri);

            if ($isPublic) {
                // Return error response as you cannot turn on a toggle from a public URI
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                echo json_encode(array('error' => 'Cannot turn on a toggle from a public URI'));
            } else {
                // Toggle is not public, continue with the action
                $toggle = new Toggle();

                $toggle->setUserId($this->getCurrentUserId());
                $toggle->setShutdownDate(
                    !empty($data['shutdown_date']) ? $data['shutdown_date'] : null
                );
                $toggle->setState(true);
                $toggle->setToggleId($data['id']);
                $toggle->setTurnOnDate($this->getActualDateTime());

                try {
                    $toggle->canTurnOn();
                    $this->toggleMapper->turnOnUser($toggle);

                    // Return success response
                    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                    echo json_encode(array('message' => 'Toggle turned on successfully'));
                } catch (ValidationException $ex) {
                    // Return error response
                    header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                    echo json_encode(array('error' => $ex->getMessage()));
                }
            }
        } else {
            // Handle missing URI error
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => 'URI not specified'));
        }
    }

    public function offLink() {
        // Assuming data is sent via POST request in JSON format
        $data = json_decode(file_get_contents('php://input'), true);

        // Retrieve public URI from the request data
        $publicUri = isset($data['uri']) ? $data['uri'] : null;

        if ($publicUri) {
            $isPublic = $this->toggleMapper->isUriPublic($publicUri);

            if ($isPublic) {
                // Return error response as you cannot turn off a toggle from a public URI
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                echo json_encode(array('error' => 'Cannot turn off a toggle from a public URI'));
            } else {
                // Toggle is not public, continue with the action
                $toggle = new Toggle();

                $toggle->setUserId($this->getCurrentUserId());
                $toggle->setState(false);
                $toggle->setToggleId($data['id']);
                $toggle->setShutdownDate(null);

                try {
                    $toggle->canTurnOff();
                    $this->toggleMapper->turnOffUser($toggle);

                    // Return success response
                    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                    echo json_encode(array('message' => 'Toggle turned off successfully'));
                } catch (ValidationException $ex) {
                    // Return error response
                    header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                    echo json_encode(array('error' => $ex->getMessage()));
                }
            }
        } else {
            // Handle missing URI error
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => 'URI not specified'));
        }
    }

    public function offUser() {
        // Assuming data is sent via POST request in JSON format
        $data = json_decode(file_get_contents('php://input'), true);

        // Continue with similar logic as offLink but specific to offUser
        if (isset($data['id'])) {
            $toggle = new Toggle();

            $toggle->setUserId($this->getCurrentUserId());
            $toggle->setState(false);
            $toggle->setToggleId($data['id']);
            $toggle->setShutdownDate(null);

            try {
                $toggle->canTurnOff();
                $this->toggleMapper->turnOffUser($toggle);

                // Return success response
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                echo json_encode(array('message' => 'Toggle turned off successfully'));
            } catch (ValidationException $ex) {
                // Return error response
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                echo json_encode(array('error' => $ex->getMessage()));
            }
        } else {
            // Handle missing ID error
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => 'Toggle ID not specified'));
        }
    }


    public function delete() {
        // Assuming you receive the toggle ID via GET request
        $toggleId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($toggleId) {
            // Retrieve toggle details from the database
            $toggle = $this->toggleMapper->getToggleById($toggleId);

            if (!$toggle) {
                // Return error response as no toggle found with the provided ID
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                echo json_encode(array('error' => 'No toggle found with the provided ID'));
            } elseif ($toggle['user_id'] !== $this->getCurrentUserId()) {
                // Return error response as the current user is not the owner of the toggle
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
                echo json_encode(array('error' => 'You are not the owner of this toggle'));
            } else {
                // Delete the toggle
                $isDeleted = $this->toggleMapper->delete($toggleId);

                if ($isDeleted) {
                    // Return success response
                    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                    echo json_encode(array('message' => 'Toggle deleted successfully'));
                } else {
                    // Return error response if deletion fails
                    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                    echo json_encode(array('error' => 'Failed to delete toggle'));
                }
            }
        } else {
            // Handle missing toggle ID error
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            echo json_encode(array('error' => 'Toggle ID not specified'));
        }
    }
}