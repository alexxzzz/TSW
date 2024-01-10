import { IoMdExit } from "react-icons/io";


function SubscribedSwitch({ name, date, description, state, unsubscribeCallBack }) {
  return (
    <div className="switchBox">
      <label className="switch">
      <input type="checkbox"  checked={state} readOnly/>
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>Name:{name}</h3>
        <h3>Date: {date}</h3>
        <p>Description: {description}</p>
      </div>
      <div className="switchIcons">
      <IoMdExit onClick={unsubscribeCallBack} size={24} />
      </div>
    </div>
  );
}

export default SubscribedSwitch;
