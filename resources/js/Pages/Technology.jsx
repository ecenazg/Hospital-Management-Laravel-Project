import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const Technology = ({ technologies }) => {
  return (
    <div>
      <h1>Medical Technologies</h1>
      <div className="technology-list">
        {technologies.map((technology) => (
          <div key={technology.id} className="technology-item">
            <div className="technology-image">
              <img src={technology.imgURL} alt={technology.name} />
            </div>
            <div className="technology-details">
              <h2>{technology.name}</h2>
              <p>{technology.description}</p>
            </div>
          </div>
        ))}
      </div>
      <InertiaLink href="/">Go back to Home</InertiaLink>
    </div>
  );
};

export default Technology;
