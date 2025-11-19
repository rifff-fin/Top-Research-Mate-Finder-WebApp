import api from '@/services/api';

// Get chats
export const getChats = async () => {
  try {
    const response = await api.get('api.php', {
      params: { action: 'getChats' }
    });
    return response.data;
  } catch (error) {
    console.error('Get chats error:', error);
    return null;
  }
};

// Send a chat message
export const sendChat = async (messageData) => {
  try {
    const response = await api.post('api.php', {
      action: 'sendChat',
      ...messageData
    });
    return response.data;
  } catch (error) {
    console.error('Send chat error:', error);
    return null;
  }
};
