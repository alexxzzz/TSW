import { FaBars, FaRegComment, FaUser } from 'react-icons/fa';

function DashboardNav() {
  return (
    <nav className="dashboardNav">
      <FaBars className="sidebarIcon" size={24} />
      <FaRegComment className="fa-regular fa-message" size={24} />
      <FaUser className="userIcon" size={24} />
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

