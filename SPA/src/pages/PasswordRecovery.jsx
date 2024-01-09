import React from "react";
import { Link } from "react-router-dom";
import Footer from "../components/footer";
import { useTranslation } from "react-i18next";

function PasswordRecovery() {
  const { t } = useTranslation();

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
            <input id="email" type="email" placeholder={t("register.email")} required />
            <button className="submitButton" type="submit">
              <span>{t("passwordRecovery.recoverPassword")}</span>
            </button>
            <Link to="/">{t("passwordRecovery.goBackToHomePage")}</Link>
          </form>
        </div>
      </div>
      <Footer />
    </div>
  );
}

export default PasswordRecovery;
