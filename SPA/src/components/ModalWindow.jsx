import React from 'react';
import { useTranslation } from 'react-i18next';
import { AiOutlineCloseCircle } from 'react-icons/ai';
import '../styles/styles.css';

function ModalWindow() {
  const { t } = useTranslation();

  return (
    <div className="modalWindow" id="modalWindow">
      <div className="modal">
        <AiOutlineCloseCircle id="close" className="fa-m" />
        <h1>{t('modalWindow.addSwitch')}</h1>
        <input type="text" placeholder={t('modalWindow.name')} required />
        <input type="text" placeholder={t('modalWindow.duration')} required />
        <button id="createSwitch" type="submit" className="GenericButton">
          <span>{t('modalWindow.create')}</span>
        </button>
      </div>
    </div>
  );
}

export default ModalWindow;
