import { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import SubscribedSwitch from './SubscribedSwitch';
import { useAuth } from '../context/AuthContext';
import switchService from '../services/switchService';
import Search from './Search';


function SubscribedSwitchContainer() {
    const { t } = useTranslation();
    const [switches, setSwitches] = useState([]);
    const { getAuthCredentials } = useAuth();
    const [modalAddOpen, setModalAddOpen] = useState(false);

    const unsubscribe = async (id) => {
      switchService.unsubsribe(id, getAuthCredentials());
      fetchSwitches();
    };

    useEffect(() => {
        fetchSwitches();
      }, []);

    const fetchSwitches = async () => {
        try {
          const response = await fetch('http://localhost:8080/subscribed', {
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

      const openAddModal = () => {
        setModalAddOpen(true);
      };
    
      const closeAddModal = () => {
        setModalAddOpen(false);
      };

      return (
        <div className="switchContainer">
          <button className="add-button" onClick={openAddModal}>{t('switchContainer.addSwitch')}</button>
          {switches.length === 0 ? (
            <h1>{t('switchContainer.noSwitchesAvailable')}</h1>
          ) : (
            switches.map((toggle) => (
              <SubscribedSwitch
                key={toggle.public_id}
                id={toggle.public_id}
                description={toggle.toggle_description}
                name={toggle.toggle_name}
                state={toggle.state}
                date={toggle.shutdown_date}
                unsubscribeCallBack={() => unsubscribe(toggle.public_id)}
              />
            ))
          )}
          <Search isOpen={modalAddOpen} onClose={closeAddModal} />
        </div>   
      )
      
}

export default SubscribedSwitchContainer