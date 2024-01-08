import { useState, useEffect } from 'react';
import Switch from './Switch';
import { useAuth } from '../context/AuthContext';
import switchService from '../services/switchService';
import Modal from './switchModalInfo';

function SwitchContainer() {
  const [ switches, setSwitches ] = useState([]);
  const { getAuthCredentials } = useAuth();
  const [selectedSwitchId, setSelectedSwitchId] = useState(null);
  const [modalOpen, setModalOpen] = useState(false);

  const deleteSwitch = async (id) => {
    switchService.deleteItem(id, getAuthCredentials());
    setSwitches((switches) => switches.filter((sw) => sw.id !== id));
  }

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
        throw new Error('Error al obtener los switches');
      }

      const switchesData = await response.json();
      setSwitches(switchesData);
    } catch (error) {
      console.error('Error:', error);
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

  useEffect(() => {
    fetchSwitches();
  }, []);

  return (
    <div>
      <div className="switchContainer">
        {switches.length === 0 ? (
          <h1>No hay switches disponibles</h1>
        ) : (
          switches.map((toggle) => (
            <Switch
              key={toggle.id}
              id={toggle.id}
              description={toggle.description}
              deleteCallback={() => deleteSwitch(toggle.id)}
              shareCallback={() => openModal(toggle.id)}
              name={toggle.name}
              state={toggle.state}
              date={toggle.date}
            />
          ))
        )}
      </div>
      <Modal isOpen={modalOpen} onClose={closeModal} switchId={selectedSwitchId} />
    </div>
  );
}

export default SwitchContainer;
