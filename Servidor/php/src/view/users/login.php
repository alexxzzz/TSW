<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

    <div class="signUpIn">
      <div class="container">
        <div class="formContainer">
          <div class="registerContainer">
            <div class="logo">
              <h1 href="index.php?controller=users&amp;action=login">Iam</h1>
              <label class="switchLogo">
                <input type="checkbox" />
                <span class="slider round"></span>
              </label>
              <h1>N</h1>
            </div>
          </div>
          <div class="ejemplo">
<form class="loginForm" action="index.php?controller=users&amp;action=login" method="POST">
	<input type="text" name="username" placeholder="Usuario"> 
	<input type="password" name="passwd" placeholder="Contraseña">
	<button id="btn" class="submitButton" type="submit">
                <span>Iniciar Sesion</span>
              </button>
</form>
</div>
          <div class="loginLinks">
            <a href="./forgotPassword.html">Contraseña olvidada?</a>
            <a href="index.php?controller=users&amp;action=register">No tienes cuenta?</a>
          </div>
        </div>
	</div>
    </div>
