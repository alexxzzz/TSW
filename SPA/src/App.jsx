import SignIn from './pages/SignIn';
import Dashboard from './pages/dashboard'; 
import Register from './pages/Register'
import PasswordRecovery from './pages/PasswordRecovery'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import DashboardSubscribed from './pages/subscribed';
import SwitchInfo from './pages/SwitchInfo';

function App() {
  return (
    <AuthProvider>
    <Router>
      <Routes>
        <Route path="/" element={<SignIn />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/subscribed" element={<DashboardSubscribed/>}/>
        <Route path="/password-recovery" element={<PasswordRecovery />} />
        <Route path="/sign-up" element={<Register />} />
        <Route path="/toggle/:toggleURI" element={<SwitchInfo/>} />
      </Routes>
    </Router>
    </AuthProvider>
  );
}

export default App;
