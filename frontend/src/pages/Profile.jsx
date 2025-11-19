import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { getProfile, updateProfile } from '../services/authService';

const Profile = () => {
  const { id } = useParams();
  const [profile, setProfile] = useState(null);
  const [editMode, setEditMode] = useState(false);
  const [formData, setFormData] = useState({});

  useEffect(() => {
    const fetchData = async () => {
      const data = await getProfile(id);
      setProfile(data);
      setFormData(data || {});
    };
    fetchData();
  }, [id]);

  const handleUpdate = async () => {
    await updateProfile(id, formData);
    setEditMode(false);
  };

  if (!profile) return <div>Loading...</div>;

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">Profile</h1>
      {editMode ? (
        <div>
          <input
            className="border p-2 mb-2 w-full"
            value={formData.name || ''}
            onChange={(e) => setFormData({ ...formData, name: e.target.value })}
          />
          <button className="bg-blue-500 text-white p-2 rounded" onClick={handleUpdate}>
            Save
          </button>
          <button className="bg-gray-500 text-white p-2 rounded ml-2" onClick={() => setEditMode(false)}>
            Cancel
          </button>
        </div>
      ) : (
        <div>
          <h2 className="text-xl">{profile.name}</h2>
          <p>Institution: {profile.institution}</p>
          <button className="bg-green-500 text-white p-2 rounded" onClick={() => setEditMode(true)}>
            Edit
          </button>
        </div>
      )}
    </div>
  );
};

export default Profile;