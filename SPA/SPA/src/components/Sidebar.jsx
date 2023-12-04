import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faInstagram, faTwitter, faLinkedin, faGithub } from '@fortawesome/free-brands-svg-icons';

function Sidebar() {
  return (
    <sidebar>
      <i className="fa-solid fa-x closeIcon"></i>
      <div className="logo logoMod">
        <h1>Iam</h1>
        <label className="switchLogo switchLogoMod">
          <input type="checkbox" />
          <span className="slider round"></span>
        </label>
        <h1>N</h1>
      </div>
      <ul>
        <a href="#">Mis switches</a>
        <a href="#">Suscritos</a>
        <div className="sidebarFooter">
          <a href="./signIn.html" className="logout">Logout</a>
          <div className="socialNetworks">
            <a href="https://google.com" target="_blank" rel="noreferrer">
              <FontAwesomeIcon icon={faInstagram} />
            </a>
            <a href="https://google.com" target="_blank" rel="noreferrer">
              <FontAwesomeIcon icon={faTwitter} />
            </a>
            <a href="https://google.com" target="_blank" rel="noreferrer">
              <FontAwesomeIcon icon={faLinkedin} />
            </a>
            <a href="https://google.com" target="_blank" rel="noreferrer">
              <FontAwesomeIcon icon={faGithub} />
            </a>
          </div>
        </div>
      </ul>
    </sidebar>
  );
}

export default Sidebar;
