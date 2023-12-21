import { useState, useEffect } from 'react';
import Switch from './Switch';

function SwitchContainer() {
  const [switches, setSwitches] = useState([]);

  useEffect(() => {
    fetchSwitches();
  }, []);

  const fetchSwitches = async () => {
    try {
      const response = await fetch('/toggle'); // Reemplaza con la ruta correcta
      if (!response.ok) {
        throw new Error('Error al obtener los switches');
      }
      const switchesData = await response.json();
      setSwitches(switchesData);
    } catch (error) {
      console.error('Error:', error);
      // Maneja el error, muestra un mensaje al usuario, etc.
    }
  };

  return (
    <div className="switchContainer">
      {switches.map((toggle) => (
        <Switch
          key={toggle.id}
          id={toggle.id}
          name={toggle.name}
          state={toggle.state}
          date={toggle.date}
        />
      ))}
    </div>
  );
}

export default SwitchContainer;
