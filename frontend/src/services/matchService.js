import api from "@/services/api";

// Get all matches for logged-in user
export const getMatches = async () => {
  try {
    const response = await api.get("api.php", {
      params: { action: "getMatches" },
    });
    return response.data;
  } catch (error) {
    console.error("Get matches error:", error);
    return null;
  }
};

// Add a new match
export const addMatch = async (matchId) => {
  try {
    const response = await api.post("api.php", {
      action: "addMatch",
      match_id: matchId,
    });
    return response.data;
  } catch (error) {
    console.error("Add match error:", error);
    return null;
  }
};
