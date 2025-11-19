import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav className="bg-gray-800 text-white p-4">
      <div className="container mx-auto flex justify-between">
        <Link to="/" className="text-xl font-bold">Top Research Mate Finder</Link>
        <div className="space-x-4">
          <Link to="/">Home</Link>
          <Link to="/research">All Research</Link>
          <Link to="/matches">All Mates</Link>
          <Link to="/about">About</Link>
          <Link to="/login">Login</Link>
          <Link to="/register">Register</Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;