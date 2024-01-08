import { AiOutlineCloseCircle } from 'react-icons/ai';
import '../styles/styles.css';

function ModalWindow() {
  return (
    <div className="modalWindow" id="modalWindow">
      <div className="modal">
        <AiOutlineCloseCircle id="close" className="fa-m" />
        <h1>Añadir switch</h1>
        <input type="text" placeholder="nombre" required />
        <input type="text" placeholder="duracion" required />
        <button id="createSwitch" type="submit" className="GenericButton">
          <span>Crear</span>
        </button>
      </div>
    </div>
  );
}

export default ModalWindow;
