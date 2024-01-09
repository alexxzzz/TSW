import React from 'react';
import { useTranslation } from 'react-i18next';
import { FaInstagram, FaTwitter, FaLinkedin, FaGithub } from 'react-icons/fa';
import '../styles/styles.css';
import LanguageSwitch from './../components/LanguageSwitch';

function Footer() {
  const { t } = useTranslation();

  return (
    <footer>
      
      <div className="footerContainer">
        <h4 className="inferior__titulo">{t('footer.followUs')}</h4>
        <a href="https://instagram.com" target="_blank" rel="noreferrer">
          <FaInstagram color='white' size={24} />
        </a>
        <a href="https://twitter.com" target="_blank" rel="noreferrer">
          <FaTwitter color='white' size={24} />
        </a>
        <a href="https://linkedin.com" target="_blank" rel="noreferrer">
          <FaLinkedin color='white' size={24} />
        </a>
        <a href="https://github.com" target="_blank" rel="noreferrer">
          <FaGithub color='white' size={24} />
        </a>
        <LanguageSwitch />
        <p>{t('footer.allRightsReserved')}</p>
      </div>
    </footer>
  );
}

export default Footer;
