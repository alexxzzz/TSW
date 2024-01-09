import React, { useState } from 'react';
import { useTranslation } from 'react-i18next';
import Footer from '../components/footer';
import '../styles/styles.css';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

function SignIn() {
  const { t } = useTranslation();
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
        const errorData = await response.json();
        setError(errorData.message || t('signIn.error'));
      }
    } catch (error) {
      console.error('Error during sign-in:', error);
      setError(t('signIn.errorDefault'));
    }
  };

  return (
    <div className="signUpIn">
      <div className="container">
        <div className="formContainer">
          <div className="registerContainer">
            <div className="logo">
              <Link to="/">
                <h1>Iam</h1>
              </Link>
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
                placeholder={t('signIn.username')}
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                required
              />
              <input
                id="password"
                type="password"
                placeholder={t('signIn.password')}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
              <button id="btn" className="submitButton" type="submit">
                <span>{t('signIn.loginButton')}</span>
              </button>
            </form>
          </div>
          <div className="loginLinks">
            <Link to="/password-recovery">{t('signIn.forgotPassword')}</Link>
            <Link to="/sign-up">{t('signIn.noAccount')}</Link>
          </div>
        </div>
      </div>
      <Footer />
      {error && <p>{error}</p>}
    </div>
  );
}

export default SignIn;
