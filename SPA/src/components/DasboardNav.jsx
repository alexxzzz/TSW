import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBars, faMessage, faUser } from '@fortawesome/free-solid-svg-icons';

function DashboardNav() {
  return (
    <nav className="dashboardNav">
      <FontAwesomeIcon icon={faBars} className="sidebarIcon" size="2x" />
      <FontAwesomeIcon icon={faMessage} className="fa-regular fa-message" size="2x" />
      <FontAwesomeIcon icon={faUser} className="userIcon" size="2x" />
      <div className="menu">
        <ul>
          <li><a href="#">Example</a></li>
          <li><a href="#">Example</a></li>
          <li><a href="#">Example</a></li>
          <li><a href="#">Example</a></li>
        </ul>
      </div>
    </nav>
  );
}

export default DashboardNav;
