import React, { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import Switch from './Switch';
import { useAuth } from '../context/AuthContext';
import switchService from '../services/switchService';
import Modal from './switchModalInfo';
import ModalAddSwitch from './switchModalAdd';

function SwitchContainer() {
  const { t } = useTranslation();
  const [switches, setSwitches] = useState([]);
  const { getAuthCredentials } = useAuth();
  const [selectedSwitchId, setSelectedSwitchId] = useState(null);
  const [modalOpen, setModalOpen] = useState(false);
  const [modalAddOpen, setModalAddOpen] = useState(false);

  const deleteSwitch = async (id) => {
    switchService.deleteItem(id, getAuthCredentials());
    setSwitches((switches) => switches.filter((sw) => sw.id !== id));
  };

  const turnOnSwitch = async (id) => {
    await switchService.turnOnSwitch(id, getAuthCredentials());
    fetchSwitches();
  };

  const turnOffSwitch = async (id) => {
    await switchService.turnOffSwitch(id, getAuthCredentials());
    fetchSwitches();
  };

  const fetchSwitches = async () => {
    try {
      const response = await fetch('http://localhost:8080/toggle', {
        headers: {
          'Authorization': `Basic ${getAuthCredentials()}`,
        },
      });

      if (!response.ok) {
        if (response.status === 401) {
          window.location.href = '/'; // Utiliza window.location.href para redirigir
        }
        throw new Error(t('switchContainer.errorGettingSwitches'));
      }

      const switchesData = await response.json();
      setSwitches(switchesData);
    } catch (error) {
      console.error('Error:', error);
    }
  };

  const handleAddSwitch = async (newSwitchData) => {
    try {
      const response = await switchService.addItem(newSwitchData, getAuthCredentials());

      if (!response.ok) {
        throw new Error(t('switchContainer.errorAddingSwitch'));
      }

      fetchSwitches();
    } catch (error) {
      console.error('Error al agregar el switch:', error);
    } finally {
      closeAddModal(); 
    }
  };

  const openModal = (id) => {
    setSelectedSwitchId(id);
    setModalOpen(true);
  };

  const closeModal = () => {
    setModalOpen(false);
    setSelectedSwitchId(null);
  };

  const openAddModal = () => {
    setModalAddOpen(true);
  };

  const closeAddModal = () => {
    setModalAddOpen(false);
  };

  useEffect(() => {
    fetchSwitches();
  }, []);

  return (
    <div>
      <button className="add-button" onClick={openAddModal}>{t('switchContainer.addSwitch')}</button>
      <div className="switchContainer">
        {switches.length === 0 ? (
          <h1>{t('switchContainer.noSwitchesAvailable')}</h1>
        ) : (
          switches.map((toggle) => (
            <Switch
              key={toggle.id}
              id={toggle.id}
              description={toggle.description}
              deleteCallback={() => deleteSwitch(toggle.id)}
              shareCallback={() => openModal(toggle.id)}
              turnOnCallback={() => turnOnSwitch(toggle.id)}
              turnOffCallback={() => turnOffSwitch(toggle.id)}
              name={toggle.name}
              state={toggle.state}
              date={toggle.date}
            />
          ))
        )}
      </div>
      <Modal isOpen={modalOpen} onClose={closeModal} switchId={selectedSwitchId} />
      <ModalAddSwitch isOpen={modalAddOpen} onClose={closeAddModal} onAdd={handleAddSwitch} />
    </div>
  );
}

export default SwitchContainer;
