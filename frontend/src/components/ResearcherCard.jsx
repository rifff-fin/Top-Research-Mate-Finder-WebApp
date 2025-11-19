import { useEffect, useState } from 'react';
import { getResearcherById } from '../services/authService';

const ResearcherCard = ({ researcherId }) => {
  const [researcher, setResearcher] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      const data = await getResearcherById(researcherId);
      setResearcher(data);
    };
    fetchData();
  }, [researcherId]);

  return (
    <div className="border rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow">
      {researcher && (
        <>
          <h2 className="text-xl font-semibold">{researcher.name}</h2>
          <p className="text-gray-600">{researcher.one_line_pitch}</p>
          <p className="text-sm text-gray-500">Field: {researcher.field}</p>
          <button
            className="mt-2 bg-blue-500 text-white p-2 rounded"
            onClick={() => window.location.href = `/profile/${researcherId}`}
          >
            Connect
          </button>
        </>
      )}
    </div>
  );
};

export default ResearcherCard;