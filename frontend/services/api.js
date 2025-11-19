import axios from "axios";

const api = axios.create({
  baseURL: "http://researchmate.local/", // points to backend API
  headers: {
    "Content-Type": "application/json",
  },
});

// Attach JWT token automatically if it exists
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

// Global response interceptor for error logging
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response) {
      console.error(
        "❌ API Error:",
        error.response.status,
        error.response.data
      );
    } else {
      console.error("❌ API Error:", error.message);
    }
    return Promise.reject(error);
  }
);

export default api;
