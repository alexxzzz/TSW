import { useTranslation } from 'react-i18next';
import { useNavigate } from 'react-router-dom';
import { useState } from 'react';

function Search({ isOpen, onClose}) {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const [id, setId] = useState("");

  const handleSearch = () => {
    navigate(`/toggle/${id}`);
  };

  const handleInputChange = (event) => {
    setId(event.target.value);
  };

  return (
    <div className={`addmodal ${isOpen ? 'open' : ''}`}>
      <div className="addmodal-overlay" onClick={onClose}></div>
      <div className="addmodal-content">
        <h2>{t('modalAddSwitch.search')}</h2>
        <label>
          {t('modalAddSwitch.publicUri')}:
          <input type="text" name="name" value={id} onChange={handleInputChange} />
          
        </label>
        <button onClick={handleSearch}>
          {t('modalAddSwitch.search')}
        </button>
        <button onClick={onClose}>{t('modalAddSwitch.cancelButton')}</button>
      </div>
    </div>
  );
}

export default Search;
