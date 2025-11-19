import { useEffect, useState } from 'react';

const About = () => {
  const [aboutContent, setAboutContent] = useState('Welcome to Top Research Mate Finder, where researchers connect and collaborate on innovative projects.');

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold mb-4">About Us</h1>
      <p className="text-lg">{aboutContent}</p>
    </div>
  );
};

export default About;