import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { getAllResearch } from '../services/researchService';
import ResearchCard from '../components/ResearchCard';

const Research = () => {
  const { id } = useParams();
  const [researchList, setResearchList] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const data = await getAllResearch();
      if (data) {
        setResearchList(
          id ? data.filter(r => r.research_id === parseInt(id)) : data
        );
      }
    };
    fetchData();
  }, [id]);

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">
        {id ? 'Research Details' : 'All Research'}
      </h1>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {researchList.map((research) => (
          <ResearchCard key={research.research_id} research={research} />
        ))}
      </div>
    </div>
  );
};

export default Research;
