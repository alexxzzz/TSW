import React from 'react';

function Modal({ isOpen, onClose, switchId }) {
  return (
    <div className={`modalSwitch ${isOpen ? 'open' : ''}`}>
      <div className="modalSwitch-overlay" onClick={onClose}></div>
      <div className="modalSwitch-content">
        <h2>ID del Switch: {switchId}</h2>
        <button onClick={onClose}>Cerrar</button>
      </div>
    </div>
  );
}

export default Modal;