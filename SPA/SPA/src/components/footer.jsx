import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faInstagram, faTwitter, faLinkedin, faGithub } from '@fortawesome/free-solid-svg-icons'
import '../styles/styles.css';

function Footer() {
  return (
    <footer>
      <div className="footerContainer">
        <h4 className="inferior__titulo">Siguenos</h4>
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
        <p>Todos los derechos reservados 2023</p>
      </div>
    </footer>
  );
}

export default Footer;
