<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
$toggles = $view->getVariable("toggles");

// Supongamos que tienes un modelo y funciones para interactuar con la base de datos y obtienes los toggles del usuario de alguna manera.

// Esta función podría estar en tu controlador o en un archivo separado donde gestionas la lógica de los toggles.

function mostrarTogglesDelUsuario($toggles) {

    foreach ($toggles as $toggle) {
        echo '<div class="switchBox">';
        echo '<label class="switch">';
        echo '<input type="checkbox" checked="' . ($toggle->getState() ? 'checked' : '') . '"/>';
        echo '<span class="slider round"></span>';
        echo '</label>';
        echo '<div class="switchText">';
        echo '<h3> <strong>Nombre: ' . $toggle->getToggleName() . '</strong></h3>';
        echo '<h3>' . $toggle->getUsername() . '</h3>';
        echo '<p>' . $toggle->getDescription() . '</p>';
        echo '</div>';
        echo '<div class="switchIcons">';
        echo '<i class="fa-regular fa-trash-can"></i>';
        echo '<i class="fa-regular fa-pen-to-square"></i>';
        echo '<i class="fa-regular fa-share-from-square"></i>';
        echo '</div>';
        echo '</div>';
    }
}

// Supongamos que aquí tienes la lógica para obtener el $userId del usuario actual, por ejemplo, desde la sesión o una variable global.

// Luego, puedes llamar a esta función en tu vista para mostrar los toggles del usuario.

// Por ejemplo:
// mostrarTogglesDelUsuario($userId);
?>


   
    
    <div class="mainContainer">
      <sidebar>
        <i class="fa-solid fa-x closeIcon"></i>
        <div class="logo logoMod">
          <h1 href="./signIn.html">Iam</h1>
          <label class="switchLogo switchLogoMod">
            <input type="checkbox" />
            <span class="slider round"></span>
          </label>
          <h1>N</h1>
        </div>
        <ul>
          <a href="#">Mis switches</a>
          <a href="#">Suscritos</a>
          <div class="sidebarFooter">
            <a href="index.php?controller=users&amp;action=logout" class="logout">Logout</a>
            <div class="socialNetworks">
            <a href="https://google.com" target="_blank">
              <i class="fa-brands fa-instagram"></i
            ></a>
            <a href="https://google.com" target="_blank">
              <i class="fa-brands fa-twitter"></i
            ></a>
            <a href="https://google.com" target="_blank">
              <i class="fa-brands fa-linkedin"></i
            ></a>
            <a href="https://google.com" target="_blank">
              <i class="fa-brands fa-github"></i
            ></a>
          </div>
          </div>
        </ul>
      </sidebar>
      <div class="dashboardContainer">
        <nav class="dashboardNav">
          <i class="fa-solid fa-bars fa-xl sidebarIcon"></i>
          <i class="fa-regular fa-message"></i>
          <i class="fa-regular fa-user userIcon"></i>
          <div class="menu">
          <ul>
            <li><a href="#">Example</a></li>
            <li><a href="#">Example</a></li>
            <li><a href="#">Example</a></li>
            <li><a href="#">Example</a></li>
          </ul>
        </div>
        </nav>
        <nav class="dashboardButtons">
          <button id="addSwitch" class="GenericButton">
            <span>Crear switch</span>
          </button>
          <select class="dashboardSelect" name="select">
            <option value="id" selected>Id</option>
            <option value="nombre">Nombre</option>
            <option value="usuario">Usuario</option>
            <option value="fecha">Fecha</option>
          </select>
        </nav>
        <div class="switchContainer">
        <?php
    // Llama a la función para mostrar los toggles del usuario
    mostrarTogglesDelUsuario($toggles);
    ?>
        </div>
          
          
      </div>
    </div>
    <div class="modalWindow" id="modalWindow">
    <form class="modal" action="index.php?controller=Toggle&amp;action=add" method="POST">
    <i id="close" class="fa-solid fa-x fa-m"></i>
    <h1>Añadir switch</h1>
    <input type="text" name="name" placeholder="Nombre" required />
    <input type="text" name="description" placeholder="Descripción (opcional)" />
    <label>Estado</label>
    <input type="checkbox" name="state" id="stateCheckbox" />
    <div id="durationField" style="display: none;">
        <label>Duración (Formato DateTime)</label>
        <input type="text" name="shutdown_date" placeholder="YYYY-MM-DD HH:MM:SS" />
    </div>
    <button id="createSwitch" type="submit" class="GenericButton">
        <span>Crear</span>
    </button>
</form>
    </div>
    <script type="text/javascript" src="./js/dashboard.js"></script>

