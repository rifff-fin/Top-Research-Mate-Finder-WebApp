import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import About from './pages/About';
import Dashboard from './pages/Dashboard';
import Research from './pages/Research';
import Matches from './pages/Matches';
import Profile from './pages/Profile';
import Admin from './pages/Admin';
import Chats from './pages/Chats';

function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/about" element={<About />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/research" element={<Research />} />
        <Route path="/research/:id" element={<Research />} /> {/* Dynamic route for research details */}
        <Route path="/matches" element={<Matches />} />
        <Route path="/profile/:id" element={<Profile />} />
        <Route path="/admin" element={<Admin />} />
        <Route path="/chats" element={<Chats />} />
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;