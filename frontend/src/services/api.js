import axios from "axios";

const api = axios.create({
  baseURL: "http://researchmate.local/", // Virtual host root
  headers: {
    "Content-Type": "application/json",
  },
});

// Attach JWT token if available
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Handle API errors globally
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response) {
      console.error("❌ API Error:", error.response.status, error.response.data);
    } else {
      console.error("❌ API Error:", error.message);
    }
    return Promise.reject(error);
  }
);

export default api;
