import api from "@/services/api";

// Get all research posts
export const getAllResearch = async () => {
  try {
    const response = await api.get("api.php", {
      params: { action: "getResearch" },
    });
    return response.data;
  } catch (error) {
    console.error("Get research error:", error);
    return null;
  }
};

// Add a research post
export const addResearch = async (data) => {
  try {
    const response = await api.post("api.php", {
      action: "addResearch",
      ...data,
    });
    return response.data;
  } catch (error) {
    console.error("Add research error:", error);
    return null;
  }
};
