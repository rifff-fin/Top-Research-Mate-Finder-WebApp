import api from '../services/api';

export const getRecommendations = async () => {
  try {
    const response = await api.get('/match/recommendations');
    return response.data;
  } catch (error) {
    console.error('Error fetching recommendations:', error);
    return [];
  }
};