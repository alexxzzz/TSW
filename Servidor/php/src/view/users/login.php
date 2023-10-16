<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<div class="container">
    <div class="formContainer">
        <div class="registerContainer">
        <div class="logo">
            <h1 href="./signIn.html">Iam</h1>
            <label class="switchLogo">
            <input type="checkbox" />
            <span class="slider round"></span>
            </label>
            <h1>N</h1>
        </div>
        </div>
        <div class="ejemplo">
        <form class="loginForm">
            <input id="user" type="text" placeholder="usuario" required />
            <input
            id="password"
            type="password"
            placeholder="contraseña"
            required
            />
            <button id="btn" class="submitButton" type="submit">
            <span>Iniciar Sesion</span>
            </button>
        </form>
        </div>
        <div class="loginLinks">
        <a href="./forgotPassword.html">Contraseña olvidada?</a>
        <a href="./signUp.html"><?= i18n("Register here!")?></a>
        </div>
    </div>
</div>
<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>