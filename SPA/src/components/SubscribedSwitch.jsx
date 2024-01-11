import { IoMdExit } from "react-icons/io";
import { useTranslation } from "react-i18next";


function SubscribedSwitch({ name, date, description, state, unsubscribeCallBack }) {
  const {t} = useTranslation();
  return (
    <div className="switchBox">
      <label className="switch">
      <input type="checkbox"  checked={state} readOnly/>
        <span className="slider round"></span>
      </label>
      <div className="switchText">
        <h3>{t("modalAddSwitch.name")}:{name}</h3>
        <h3>{t("modalAddSwitch.turndate")}: {date}</h3>
        <p>{t("modalAddSwitch.description")}: {description}</p>
      </div>
      <div className="switchIcons">
      <IoMdExit onClick={unsubscribeCallBack} size={24} />
      </div>
    </div>
  );
}

export default SubscribedSwitch;
