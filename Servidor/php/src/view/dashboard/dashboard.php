<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
$toggles = $view->getVariable("toggles");


function mostrarTogglesDelUsuario($toggles) {
    foreach ($toggles as $toggle) {
        $action=$toggle->getState() ? 'offUser' : 'onUser';
        echo '<div class="switchBox">';
        echo '<form id="switchForm' . $toggle->getToggleId() . '" action="index.php?controller=toggle&amp;action='.$action.'" method="POST">';
        echo '<label class="switch">';
        echo '<input type="checkbox" name=id value='.$toggle->getToggleId().' data-form-id="' . $toggle->getToggleId() . '" ' . ($toggle->getState() ? 'checked' : '') . '/>';
        echo '<span class="slider round"></span>';
        echo '</label>';
        echo '</form>';
        echo '<div class="switchText">';
        echo '<h3> <strong> Nombre: </strong> ' . $toggle->getToggleName() . '</h3>';
        echo '<p>' . $toggle->getDescription() . '</p>';
        echo '<p> <strong> URI publica: </strong> ' . $toggle->getPublicId() . '</p>';
        echo '<p> <strong> URI privada: </strong> ' . $toggle->getPrivateId() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<a href="index.php?controller=toggle&amp;action=delete&id=' . $toggle->getToggleId() . '"><i class="fa-regular fa-trash-can"></i></a>';
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
        <script>
    // Obtén todos los elementos de entrada de tipo checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var formId = this.getAttribute('data-form-id');
            var form = document.getElementById('switchForm' + formId);

            if (form) {
                form.submit();
            }
        });
    });
</script>


    

