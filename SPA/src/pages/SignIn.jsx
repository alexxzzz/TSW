import { useState } from 'react';
import Footer from '../components/footer';
import '../styles/styles.css';
import {useNavigate, Link}  from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

function SignIn() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();
  const { setAuthCredentials, getAuthCredentials } = useAuth();



  const handleSignIn = async (e) => {
    e.preventDefault();
    const basicAuth = btoa(`${username}:${password}`);
    setAuthCredentials(username, password);
  
    try {
      const response = await fetch(`http://localhost:8080/user/${username}`, {
        method: 'GET',
        headers: {
          'Authorization': `Basic ${basicAuth}`,
        },
      });
  
      if (response.ok) {
        navigate('/dashboard');
      } else {
        // Manejar errores de inicio de sesión
        const errorData = await response.json();
        setError(errorData.message || 'Error al iniciar sesión');
      }
    } catch (error) {
      console.error('Error during sign-in:', error);
      setError('Error al intentar iniciar sesión');
    }
  };
  

  return (
    <div className="signUpIn">
      <div className="container">
        <div className="formContainer">
          <div className="registerContainer">
            <div className="logo">
            <Link to="/"><h1>Iam</h1></Link>
                  <label className="switchLogo">
                    <input type="checkbox" />
                    <span className="slider round"></span>
                  </label>
            <h1>N</h1>
            </div>
          </div>
          <div className="ejemplo">
            <form className="loginForm" onSubmit={handleSignIn}>
              <input
                id="user"
                type="text"
                placeholder="usuario"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                required
              />
              <input
                id="password"
                type="password"
                placeholder="contraseña"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
              <button id="btn" className="submitButton" type="submit">
                <span>Iniciar Sesión</span>
              </button>
            </form>
          </div>
          <div className="loginLinks">
            <Link to="/password-recovery">Contraseña olvidada?</Link>
            <Link to="/sign-up">No tienes cuenta?</Link>
          </div>
        </div>
      </div>
      <Footer />
      {error && <p>{error}</p>}
    </div>
  );
}

export default SignIn;
