import SignIn from './pages/SignIn';
import Dashboard from './pages/dashboard'; 
import Register from './pages/Register'
import PasswordRecovery from './pages/PasswordRecovery'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';


function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<SignIn />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/password-recovery" element={<PasswordRecovery />} />
        <Route path="/sign-up" element={<Register />} />
      </Routes>
    </Router>
  );
}

export default App;
