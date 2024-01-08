import { AiOutlineDelete, AiOutlineEdit, AiOutlineShareAlt } from 'react-icons/ai';
import switchService from '../services/switchService';



function Switch({ name, date, description, deleteCallback, shareCallback, state, turnOnCallback, turnOffCallback }) {
  return (
    <div className="switchBox">
      <label className="switch">
        <input type="checkbox"  checked={state} onChange={!state ? turnOnCallback : turnOffCallback} />
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>{name}</h3>
        <h3>{date}</h3>
        <p>{description}</p>
      </div>
      <div className="switchIcons">
        <AiOutlineDelete className="fa-regular fa-trash-can" onClick={deleteCallback} size={24} />
        <AiOutlineEdit className="fa-regular fa-pen-to-square"  size={24} />
        <AiOutlineShareAlt className="fa-regular fa-share-from-square" onClick={shareCallback} size={24} />
      </div>
    </div>
  );
}

export default Switch;
