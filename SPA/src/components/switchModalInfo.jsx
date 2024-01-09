import React from 'react';
import { useTranslation } from 'react-i18next';

function Modal({ isOpen, onClose, switchId }) {
  const { t } = useTranslation();

  return (
    <div className={`modalSwitch ${isOpen ? 'open' : ''}`}>
      <div className="modalSwitch-overlay" onClick={onClose}></div>
      <div className="modalSwitch-content">
        <h2>{t('modal.switchId', { switchId })}</h2>
        <button onClick={onClose}>{t('modal.closeButton')}</button>
      </div>
    </div>
  );
}

export default Modal;
