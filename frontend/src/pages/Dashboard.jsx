import { Link } from 'react-router-dom';

function Dashboard() {
  return (
    <div className="container">
      <h1>Dashboard</h1>
      <Link to="/research">Add Research</Link>
      <Link to="/profile">Edit Profile</Link>
      <Link to="/matches">View Matches</Link>
      <Link to="/chats">Chats</Link>
      {/* Display user's researches, matches */}
    </div>
  );
}

export default Dashboard;