import { useEffect, useState } from 'react';
import { getRecommendations } from '../services/matchService';
import ResearcherCard from '../components/ResearcherCard';

const Matches = () => {
  const [recommendations, setRecommendations] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const data = await getRecommendations();
      setRecommendations(data);
    };
    fetchData();
  }, []);

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">All Research Mates</h1>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {recommendations.map((rec) => (
          <ResearcherCard key={rec.recommended_id} researcherId={rec.recommended_id} />
        ))}
      </div>
    </div>
  );
};

export default Matches;