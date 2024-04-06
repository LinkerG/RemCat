const React = require("react");

// generateQR.jsx

const GenerateQR = ({ competitionResults }) => {
    return (
      <div>
        <h1>Resultados de la competición</h1>
        <ul>
          {competitionResults.map((result, index) => (
            <li key={index}>
              <p>Equipo: {result.teamName}</p>
              <p>Categoría: {result.category}</p>
              <p>Tiempo: {result.time}</p>
            </li>
          ))}
        </ul>
      </div>
    );
  };
  
  export default GenerateQR;  