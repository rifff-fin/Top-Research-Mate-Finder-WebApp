import { useEffect, useState } from 'react';
import { getResearch } from '../services/researchService';
import ResearchCard from '../components/ResearchCard';

const Home = () => {
  const [topResearch, setTopResearch] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const researchData = await getResearch();
        console.log('Research data:', researchData);
        setTopResearch(researchData || []);
      } catch (err) {
        console.error('Fetch error:', err);
      }
    };
    fetchData();
  }, []);

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">Top Research</h1>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        {topResearch.map((research) => (
          <ResearchCard key={research.research_id} research={research} />
        ))}
      </div>
    </div>
  );
};

export default Home;
