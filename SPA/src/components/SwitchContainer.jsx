import { useState, useEffect } from 'react';
import Switch from './Switch';
import { useAuth } from '../context/AuthContext';
import switchService from '../services/switchService';

function SwitchContainer() {
  const [ switches, setSwitches ] = useState([]);
  const { getAuthCredentials } = useAuth();

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
        throw new Error('Error al obtener los switches');
      }

      const switchesData = await response.json();
      setSwitches(switchesData);
    } catch (error) {
      console.error('Error:', error);
    }
  };

  useEffect(() => {
    fetchSwitches();
  }, []);

  return (
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
            name={toggle.name}
            state={toggle.state}
            date={toggle.date}
          />
        ))
      )}
    </div>
  );
}

export default SwitchContainer;
