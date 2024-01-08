import { FaInstagram, FaTwitter, FaLinkedin, FaGithub } from 'react-icons/fa';

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
          <a href="./" className="logout">Logout</a>
          <div className="socialNetworks">
            <a href="https://instagram.com" target="_blank" rel="noreferrer">
              <FaInstagram size={24} />
            </a>
            <a href="https://twitter.com" target="_blank" rel="noreferrer">
              <FaTwitter size={24} />
            </a>
            <a href="https://linkedin.com" target="_blank" rel="noreferrer">
              <FaLinkedin size={24} />
            </a>
            <a href="https://github.com" target="_blank" rel="noreferrer">
              <FaGithub size={24} />
            </a>
          </div>
        </div>
      </ul>
    </sidebar>
  );
}

export default Sidebar;
