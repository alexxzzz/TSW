<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Dashboard");
$errors = $view->getVariable("errors");
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
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
            <i class="fa-regular fa-trash-can"></i>
            <i class="fa-regular fa-pen-to-square"></i>
            <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
          <div class="switchBox">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
            <div class="switchText">
              <h3>Nombre</h3>
              <h3>Usuario</h3>
              <h3>Fecha</h3>
            </div>
            <div class="switchIcons">
              <i class="fa-regular fa-trash-can"></i>
              <i class="fa-regular fa-pen-to-square"></i>
              <i class="fa-regular fa-share-from-square"></i>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modalWindow" id="modalWindow">
      <div class="modal">
        <i id="close" class="fa-solid fa-x fa-m"></i>
        <h1>Añadir switch</h1>
        <input type="text" placeholder="nombre" required />
        <input type="text" placeholder="duracion" required />
        <button id="createSwitch" type="submit" class="GenericButton">
          <span>Crear</span>
        </button>
      </div>
    </div>

