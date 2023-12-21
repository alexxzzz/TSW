import Footer from "../components/footer";
import { useState } from "react";
import {useNavigate, Link}  from 'react-router-dom';

function Register() {
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Construir el objeto de datos a enviar al backend
    const userData = {
      username: username,
      email: email,
      password: password,
    };

    try {
      const response = await fetch("/user", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(userData),
      });

      if (response.ok) {
        navigate.push('/login')
        console.log("Usuario registrado correctamente");
      } else {
        // Manejar errores de registro
        const errorData = await response.json();
        console.error("Error al registrar:", errorData);
      }
    } catch (error) {
      console.error("Error en la solicitud:", error);
    }
  };

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
          <form className="loginForm" onSubmit={handleSubmit}>
            <input
              id="name"
              type="text"
              placeholder="usuario"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              required
            />
            <input
              id="email"
              type="email"
              placeholder="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
            <input
              id="password"
              type="password"
              placeholder="contraseña"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
            <button className="submitButton" type="submit">
              <span>Registrarse</span>
            </button>
            <Link to="/">Volver</Link>
          </form>
        </div>
      </div>
      <Footer></Footer>
    </div>
  );
}

export default Register;
