import DashboardNav from "../components/DasboardNav";
import Sidebar from "../components/Sidebar";
import SubscribedSwitchContainer from "../components/SubscribedSwitchContainer";

function DashboardSubscribed() {
    return (
        <div className="dashboard">
            <Sidebar />
            <div className="container">
                <DashboardNav />
                <SubscribedSwitchContainer />
            </div>
        </div>
    )
}

export default DashboardSubscribed;