<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
$toggles = $view->getVariable("toggles");


function mostrarTogglesDelUsuario($toggles) {
    foreach ($toggles as $toggle) {
        echo '<div class="switchBox">';
        echo '<label class="switch">';
        echo '<input type="checkbox" checked="' . ($toggle->getState() ? 'checked' : '') . '"/>';
        echo '<span class="slider round"></span>';
        echo '</label>';
        echo '<div class="switchText">';
        echo '<h3> <strong>Nombre: ' . $toggle->getToggleName() . '</strong></h3>';
        echo '<p>' . $toggle->getDescription() . '</p>';
        echo '<p>' . $toggle->getToggleId() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<a href="index.php?controller=toggle&amp;action=delete&id=' . $toggle->getToggleId() . '"><i class="fa-regular fa-trash-can"></i></a>';
        echo '<i class="fa-regular fa-pen-to-square"></i>';
        echo '<i class="fa-regular fa-share-from-square"></i>';
        echo '</div>';
        echo '</div>';
    }
}

?>

        <div class="switchContainer">
        <?php
        if (!empty($toggles)) {
            mostrarTogglesDelUsuario($toggles);
        } else {
            echo '<h1>No se encontraron switches para este usuario.</h1>';
        }
        ?>

        </div>
          
    </div>
    

