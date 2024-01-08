// ModalAddSwitch.js

import React, { useState } from 'react';

function ModalAddSwitch({ isOpen, onClose, onAdd }) {
  const [newSwitchData, setNewSwitchData] = useState({
    name: '',
    description: '',
    namestate: false,
    shutdown_date: '',
  });

  const handleInputChange = (e) => {
    const { name, value, type, checked } = e.target;
    setNewSwitchData((prevData) => ({
      ...prevData,
      [name]: type === 'checkbox' ? checked : value,
    }));
  };

  const handleAdd = () => {
    onAdd(newSwitchData);
  };

  return (
    <div className={`addmodal ${isOpen ? 'open' : ''}`}>
      <div className="addmodal-overlay" onClick={onClose}></div>
      <div className="addmodal-content">
        <h2>Agregar Switch</h2>
        <label>
          Nombre:
          <input type="text" name="name" value={newSwitchData.name} onChange={handleInputChange} />
        </label>
        <label>
          Descripción:
          <textarea name="description" value={newSwitchData.description} onChange={handleInputChange} />
        </label>
        <label>
          Encendido:
          <input type="checkbox" name="namestate" checked={newSwitchData.namestate} onChange={handleInputChange} />
        </label>
        {newSwitchData.isOn && (
          <label>
            Fecha de apagado:
            <input
              type="datetime-local"
              name="shutdown_date"
              value={newSwitchData.shutdown_date}
              onChange={handleInputChange}
              min={new Date().toISOString().slice(0, 16)}
            />
          </label>
        )}
        <button onClick={handleAdd}>
          Agregar
        </button>
        <button onClick={onClose}>Cancelar</button>
      </div>
    </div>
  );
}

export default ModalAddSwitch;
