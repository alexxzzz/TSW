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
         {/* <FontAwesomeIcon icon={faTrashAlt} className="fa-regular fa-trash-can" />
        <FontAwesomeIcon icon={faEdit} className="fa-regular fa-pen-to-square" />
        <FontAwesomeIcon icon={faShareSquare} className="fa-regular fa-share-from-square" /> */}
      </div>
    </div>
  );
}

export default Switch;
