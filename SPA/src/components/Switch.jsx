import { AiOutlineDelete, AiOutlineEdit, AiOutlineShareAlt } from 'react-icons/ai';

function Switch({ name, date, description }) {
  return (
    <div className="switchBox">
      <label className="switch">
        <input type="checkbox" />
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>{name}</h3>
        <h3>{date}</h3>
        <p>{description}</p>
      </div>
      <div className="switchIcons">
        <AiOutlineDelete className="fa-regular fa-trash-can" size={24} />
        <AiOutlineEdit className="fa-regular fa-pen-to-square" size={24} />
        <AiOutlineShareAlt className="fa-regular fa-share-from-square" size={24} />
      </div>
    </div>
  );
}

export default Switch;
