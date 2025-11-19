import { useEffect, useState } from 'react';
import { getPendingResearch, approveResearch } from '../services/researchService';

const Admin = () => {
  const [pendingResearch, setPendingResearch] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const data = await getPendingResearch();
      setPendingResearch(data);
    };
    fetchData();
  }, []);

  const handleApprove = async (researchId) => {
    await approveResearch(researchId);
    setPendingResearch(pendingResearch.filter(r => r.research_id !== researchId));
  };

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">Admin Panel</h1>
      <div className="grid grid-cols-1 gap-4">
        {pendingResearch.map((research) => (
          <div key={research.research_id} className="border p-4 rounded">
            <h2 className="text-xl">{research.title}</h2>
            <button
              className="mt-2 bg-green-500 text-white p-2 rounded"
              onClick={() => handleApprove(research.research_id)}
            >
              Approve
            </button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Admin;