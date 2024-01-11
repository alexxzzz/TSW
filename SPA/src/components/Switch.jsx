import { AiOutlineDelete, AiOutlineEdit, AiOutlineShareAlt } from 'react-icons/ai';
import { useTranslation } from "react-i18next";
import { MdLockOutline } from "react-icons/md";




function Switch({ name, date, description, deleteCallback, shareCallback, state, turnOnCallback, turnOffCallback, privateShareCallback }) {
  const {t} = useTranslation();
  return (
    <div className="switchBox">
      <label className="switch">
        <input type="checkbox"  checked={state} onChange={!state ? turnOnCallback : turnOffCallback} />
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>{t("modalAddSwitch.name")}: {name}</h3>
        <h3>{t("modalAddSwitch.turndate")}: {date}</h3>
        <p>{t("modalAddSwitch.description")}: {description}</p>
      </div>
      <div className="switchIcons">
        <AiOutlineDelete onClick={deleteCallback} size={24} />
        <AiOutlineShareAlt  onClick={shareCallback} size={24} />
        <MdLockOutline  onClick={privateShareCallback} size={24} />
      </div>
    </div>
  );
}

export default Switch;
