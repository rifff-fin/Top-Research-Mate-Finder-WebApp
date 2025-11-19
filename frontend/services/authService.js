import api from '../services/api';

export const register = async (data) => {
  return api.post('/auth/register', data);
};

export const login = async (data) => {
  const response = await api.post('/auth/login', data);
  localStorage.setItem('token', response.data.token);
  return response;
};

export const getResearcherById = async (researcherId) => {
  try {
    const response = await api.get(`/profile/${researcherId}`);
    return response.data;
  } catch (error) {
    console.error('Error fetching researcher:', error);
    return null;
  }
};

export const getProfile = async (userId) => {
  try {
    const response = await api.get(`/profile/${userId}`);
    return response.data;
  } catch (error) {
    console.error('Error fetching profile:', error);
    return null;
  }
};

export const updateProfile = async (userId, data) => {
  try {
    const response = await api.put(`/profile/${userId}`, data);
    return response.data;
  } catch (error) {
    console.error('Error updating profile:', error);
    return null;
  }
};