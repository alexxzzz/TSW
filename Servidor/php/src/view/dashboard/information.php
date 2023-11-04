<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$toggle = $view->getVariable("toggle");


function mostrarTogglesDelUsuario($toggle) {
        $action=$toggle->getState() ? 'offLink' : 'onLink';
        $checked = $toggle->getState() ? 'checked' : '';
        $uri = isset($_GET['uri']) ? $_GET['uri'] : '';
        echo '<div class="switchBox">';
            echo '<form id="switchForm' . $toggle->getToggleId() . '" action="index.php?controller=toggle&amp;action='.$action. '&uri=' . $uri . '" method="POST">';
            echo '<label class="switch">';
            echo '<input type="checkbox"  data-form-id="' . $toggle->getToggleId() . '" ' . $checked . '/>';
            echo '<span class="slider round"></span>';
            echo '</label>';
            echo '</form>';
        echo '<div class="switchText">';
        echo '<h3> <strong> Nombre: </strong> ' . $toggle->getToggleName() . '</h3>';
        echo '<p> Descripcion: ' . $toggle->getDescription() . '</p>';
        echo '<p> Tiempo encendido: </p>';
        echo '<p> Fecha encendido: ' .$toggle->getTurnOnDate() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<a href="index.php?controller=subscription&amp;action=subscribe&id=' . $toggle->getToggleId() . '"><i class="fa-solid fa-plus"></i></a>';
        echo '</div>';
        echo '</div>';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/normalize.css" rel="stylesheet" />
    <link href="../../css/infoStyle.css" rel="stylesheet" />
    <title>Switch</title>
</head>
<body>
<div id="flash">
			<?= $view->popFlash() ?>
		</div>
    <div class="container">
    <div class="switchContainer">
    <?php
        if (!empty($toggle)) {
            mostrarTogglesDelUsuario($toggle);
        } else {
            echo '<h1>No se encontraron switches para este usuario.</h1>';
        }
        ?>
    </div>
    </div>
</body>
<script
src="https://kit.fontawesome.com/19c59e2dfc.js"
crossorigin="anonymous"
></script>
<script>
    // Obtén todos los elementos de entrada de tipo checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var formId = this.getAttribute('data-form-id');
            var form = document.getElementById('switchForm' + formId);

            var hiddenElement = document.createElement("input");
                hiddenElement.type = "hidden";
                hiddenElement.name = 'id';
                hiddenElement.value = formId; 

            form.appendChild(hiddenElement);
            if (form) {
                form.submit();
            }
        });
    });
</script>
</html>
        