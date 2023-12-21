import Footer from "../components/footer";
import { Link } from 'react-router-dom';

function PasswordRecovery() {
  return (
    <div className="signUpIn">
      <div className="container">
        <div className="formContainer">
          <div className="registerContainer">
            <div className="logo">
              <h1><Link to="/">Iam</Link></h1>
              <label className="switchLogo">
                <input type="checkbox" />
                <span className="slider round"></span>
              </label>
              <h1>N</h1>
            </div>
          </div>
          <form className="loginForm">
            <input
              id="email"
              type="email"
              placeholder="email"
              required
            />
            <button className="submitButton" type="submit">
              <span>Recuperar Contraseña</span>
            </button>
            <Link to="/">Volver a la página principal</Link>
          </form>
        </div>
      </div>
      <Footer />
    </div>
  );
}

export default PasswordRecovery;
