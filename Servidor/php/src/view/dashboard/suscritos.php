<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
$suscribedToggles = $view->getVariable("suscribedToggles");


function mostrarSuscribedTogglesDelUsuario($suscribedToggles) {

    foreach ($suscribedToggles as $suscribedToggle) {
        echo '<div class="switchBox">';
        echo '<label class="switch">';
        echo '<input type="checkbox" checked="' . ($suscribedToggle->getState() ? 'checked' : '') . '"/>';
        echo '<span class="slider round"></span>';
        echo '</label>';
        echo '<div class="switchText">';
        echo '<h3> <strong>Nombre: ' . $suscribedToggle->getToggleName() . '</strong></h3>';
        echo '<h3>' . $suscribedToggle->getUsername() . '</h3>';
        echo '<p>' . $suscribedToggle->getDescription() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<i class="fa-regular fa-trash-can"></i>';
        echo '<i class="fa-regular fa-pen-to-square"></i>';
        echo '<i class="fa-regular fa-share-from-square"></i>';
        echo '</div>';
        echo '</div>';
    }
}
?>


   
  
        <div class="switchContainer">
        <?php
    // Llama a la función para mostrar los suscribedToggles del usuario
    mostrarSuscritos($suscribedToggles);
    ?>
        </div>