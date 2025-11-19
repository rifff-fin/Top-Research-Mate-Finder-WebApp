import api from "@/services/api";

// Login and save token
export const login = async (email, password) => {
  try {
    const response = await api.post("api.php", {
      action: "login",
      email,
      password,
    });

    if (response.data?.token) {
      localStorage.setItem("token", response.data.token);
    }

    return response.data;
  } catch (error) {
    console.error("Login error:", error);
    return null;
  }
};

// Register new user
export const register = async (userData) => {
  try {
    const response = await api.post("api.php", {
      action: "register",
      ...userData,
    });
    return response.data;
  } catch (error) {
    console.error("Register error:", error);
    return null;
  }
};

// Logout
export const logout = () => {
  localStorage.removeItem("token");
};

// Get current user profile (JWT protected)
export const getProfile = async () => {
  try {
    const response = await api.get("api.php", {
      params: { action: "getProfile" },
    });
    return response.data;
  } catch (error) {
    console.error("Profile error:", error);
    return null;
  }
};
