import React, { useState } from 'react';
import { useTranslation } from 'react-i18next';

function ModalAddSwitch({ isOpen, onClose, onAdd }) {
  const { t } = useTranslation();
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
        <h2>{t('modalAddSwitch.addSwitch')}</h2>
        <label>
          {t('modalAddSwitch.name')}:
          <input type="text" name="name" value={newSwitchData.name} onChange={handleInputChange} />
        </label>
        <label>
          {t('modalAddSwitch.description')}:
          <textarea name="description" value={newSwitchData.description} onChange={handleInputChange} />
        </label>
        <label>
          {t('modalAddSwitch.isOn')}:
          <input type="checkbox" name="namestate" checked={newSwitchData.namestate} onChange={handleInputChange} />
        </label>
        {newSwitchData.isOn && (
          <label>
            {t('modalAddSwitch.shutdownDate')}:
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
          {t('modalAddSwitch.addButton')}
        </button>
        <button onClick={onClose}>{t('modalAddSwitch.cancelButton')}</button>
      </div>
    </div>
  );
}

export default ModalAddSwitch;
