// i18n.js
import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

i18n
  .use(initReactI18next)
  .init({
    resources: {
      en: {
        translation: {
          signIn: {
            username: 'Username',
            password: 'Password',
            loginButton: 'Login',
            forgotPassword: 'Forgot Password?',
            noAccount: 'Don\'t have an account?',
            error: 'Error logging in. Please try again.',
            errorDefault: 'Error trying to log in.',
          },
          modal: {
            switchId: 'Switch ID: {{switchId}}',
            closeButton: 'Close',
          },
          modalWindow: {
            addSwitch: 'Add Switch',
            name: 'Name',
            duration: 'Duration',
            create: 'Create',
          },
          modalAddSwitch: {
            addSwitch: 'Add Switch',
            name: 'Name',
            description: 'Description',
            isOn: 'Is On',
            shutdownDate: 'Shutdown Date',
            addButton: 'Add',
            cancelButton: 'Cancel',
          },
          sidebar: {
            mySwitches: 'My Switches',
            subscribed: 'Subscribed',
            logout: 'Logout',
          },
          footer: {
            followUs: 'Follow Us',
            allRightsReserved: 'All rights reserved 2023',
          },
          switchContainer: {
            addSwitch: 'Add Switch',
            noSwitchesAvailable: 'No switches available',
            errorGettingSwitches: 'Error getting switches',
            errorAddingSwitch: 'Error adding switch',
          },
          register: {
            username: 'Username',
            email: 'Email',
            password: 'Password',
            registerButton: 'Register',
            backLink: 'Back',
            userRegisteredSuccessfully: 'User registered successfully',
            errorRegistering: 'Error registering:',
            requestError: 'Request error:',
          },
          passwordRecovery: {
            recoverPassword: 'Recover Password',
            goBackToHomePage: 'Go back to the home page',
          },
        },
      },
      es: {
        translation: {
          signIn: {
            username: 'Usuario',
            password: 'Contraseña',
            loginButton: 'Iniciar Sesión',
            forgotPassword: '¿Olvidaste tu contraseña?',
            noAccount: '¿No tienes una cuenta?',
            error: 'Error al iniciar sesión. Por favor, inténtalo de nuevo.',
            errorDefault: 'Error al intentar iniciar sesión.',
          },
          modal: {
            switchId: 'ID del Switch: {{switchId}}',
            closeButton: 'Cerrar',
          },
          modalWindow: {
            addSwitch: 'Añadir Switch',
            name: 'Nombre',
            duration: 'Duración',
            create: 'Crear',
          },
          modalAddSwitch: {
            addSwitch: 'Agregar Switch',
            name: 'Nombre',
            description: 'Descripción',
            isOn: 'Encendido',
            shutdownDate: 'Fecha de apagado',
            addButton: 'Agregar',
            cancelButton: 'Cancelar',
          },
          sidebar: {
            mySwitches: 'Mis switches',
            subscribed: 'Suscritos',
            logout: 'Cerrar sesión',
          },
          footer: {
            followUs: 'Síguenos',
            allRightsReserved: 'Todos los derechos reservados 2023',
          },
          switchContainer: {
            addSwitch: 'Agregar Switch',
            noSwitchesAvailable: 'No hay switches disponibles',
            errorGettingSwitches: 'Error al obtener los switches',
            errorAddingSwitch: 'Error al agregar el switch',
          },
          register: {
            username: 'Usuario',
            email: 'Correo electrónico',
            password: 'Contraseña',
            registerButton: 'Registrarse',
            backLink: 'Volver',
            userRegisteredSuccessfully: 'Usuario registrado correctamente',
            errorRegistering: 'Error al registrar:',
            requestError: 'Error en la solicitud:',
          },
          passwordRecovery: {
            recoverPassword: 'Recuperar Contraseña',
            goBackToHomePage: 'Volver a la página principal',
          },
        },
      },
    },
    lng: 'en',
    fallbackLng: 'en',
    interpolation: {
      escapeValue: false,
    },
  });

export default i18n;
