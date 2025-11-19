import { useNavigate } from 'react-router-dom';

const ResearchCard = ({ research }) => {
  const navigate = useNavigate();

  return (
    <div className="border rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow">
      <h2 className="text-xl font-semibold">{research.title}</h2>
      <p className="text-gray-600">{research.description}</p>
      <p className="text-sm text-gray-500">Start: {research.start_date} - End: {research.end_date}</p>
      <button
        className="mt-2 bg-green-500 text-white p-2 rounded"
        onClick={() => navigate(`/research/${research.research_id}`)}
      >
        View Details
      </button>
    </div>
  );
};

export default ResearchCard;