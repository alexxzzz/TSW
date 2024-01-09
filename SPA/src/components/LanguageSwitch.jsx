import React, { useState } from 'react';
import { useTranslation } from 'react-i18next';

const LanguageSwitch = () => {
  const { i18n } = useTranslation();
  const [isOpen, setIsOpen] = useState(false);

  const changeLanguage = (lng) => {
    i18n.changeLanguage(lng);
    setIsOpen(false);
  };

  const currentLanguage = i18n.language;

  return (
    <div className="language-switcher">
      <div className="dropdown">
        <button className="dropbtn" onClick={() => setIsOpen(!isOpen)}>
          {currentLanguage === 'en' ? 'English' : 'Español'}
        </button>
        {isOpen && (
          <div className="dropdown-content">
            <button onClick={() => changeLanguage('en')}>English</button>
            <button onClick={() => changeLanguage('es')}>Español</button>
          </div>
        )}
      </div>
    </div>
  );
};

export default LanguageSwitch;
