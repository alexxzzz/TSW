<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
$suscribedToggles = $view->getVariable("suscribedToggles");


function mostrarSuscritos($suscribedToggles) {

    foreach ($suscribedToggles as $suscribedToggle) {
        echo '<div class="switchBox">';
        echo '<label class="switch">';
        echo '<input type="checkbox" checked="' . ($suscribedToggle->getState() ? 'checked' : '') . '"/>';
        echo '<span class="slider round"></span>';
        echo '</label>';
        echo '<div class="switchText">';
        echo '<h3> <strong>Nombre: ' . $suscribedToggle->getToggleName() . '</strong></h3>';
        echo '<h3> Usuario: ' . $suscribedToggle->getUsername() . '</h3>';
        echo '<p>' . $suscribedToggle->getDescription() . '</p>';
        echo '<p>' . $suscribedToggle->getTurnOnDate() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<a href="index.php?controller=Subscription&amp;action=unsubscribe&id=' . $suscribedToggle->getToggleId() . '"><i class="fa-regular fa-x"></i></a>';
        echo '<i class="fa-regular fa-share-from-square"></i>';
        echo '</div>';
        echo '</div>';
    }
}
?>


   
  
        <div class="switchContainer">
        <?php
        if (!empty($suscribedToggles)) {
            mostrarSuscritos($suscribedToggles);
        } else {
            echo '<h1>No estas suscrito a ningun switch.</h1>';
        }
        ?>
        </div>