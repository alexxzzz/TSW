import { useState, useEffect } from 'react';
import { useAuth } from '../context/AuthContext';
import { useParams } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { IoAddCircleOutline } from "react-icons/io5";
import switchService from '../services/switchService';
import { useNavigate } from 'react-router-dom';


function SwitchInfo() {
  const { t } = useTranslation();
  const { isUserAuthenticated, getAuthCredentials } = useAuth();
  const [switchData, setSwitchData] = useState(null);
  const { toggleURI } = useParams();
  const navigate = useNavigate();

  useEffect(() => {
    if (toggleURI) {
      fetchSwitches();
    }
  }, [toggleURI]);

  const fetchSwitches = async () => {
    console.log(getAuthCredentials());
    try {
      const response = await fetch(`http://localhost:8080/toggle/${toggleURI}`, {
        headers: {
          'Authorization': `Basic ${getAuthCredentials()}`,
        },
      });

      if (!response.ok) {
        throw new Error(t('switchContainer.errorGettingSwitches'));
      }

      const switchData = await response.json();
      setSwitchData(switchData);
    } catch (error) {
      console.error('Error fetching switch information:', error);
    }
  };

  const handleSubscribe = async () => {
    await switchService.subscribe(toggleURI, getAuthCredentials());
    navigate('/subscribed')
  };
  

  const turnOnSwitch = async (toggleURI) => {
    await switchService.turnOnLink(toggleURI);
    const updatedSwitchData = { ...switchData, toggle_state: true };
    setSwitchData(updatedSwitchData);
  };
  
  const turnOffSwitch = async (toggleURI) => {
    await switchService.turnOffLink(toggleURI);
    const updatedSwitchData = { ...switchData, toggle_state: false };
    setSwitchData(updatedSwitchData);
  };

  if (!switchData) {
    return <div>Loading...</div>;
  }

  return (
    <div className='switchInfo'>
    <div className="switchBoxUnique">
      <label className="switch">
      <input
  type="checkbox"
  checked={switchData.toggle_state}
  onChange={() =>
    switchData.toggle_state ? turnOffSwitch(toggleURI) : turnOnSwitch(toggleURI)
  }
/>
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>{t("modalAddSwitch.name")}: {switchData.toggle_name}</h3>
        <p>{t("modalAddSwitch.description")}: {switchData.toggle_description}</p>
        <p>{t("modalAddSwitch.turndate")}: {switchData.turn_on_date}</p>
      </div>
      <div className="switchIcons">
        {getAuthCredentials()!=null && (
          <IoAddCircleOutline onClick={handleSubscribe} size={24} />
        )}
      </div>
    </div>
    </div>
  );
}


export default SwitchInfo;

