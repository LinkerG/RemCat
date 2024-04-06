const { React } = require('react');

const Start = ({ title }) => (
    <html>
    <head>
        <title>{title}</title>
    </head>
    <body>
        <h1>{title}</h1>
        <p>Bienvenido a mi aplicación Express con React</p>
    </body>
    </html>
);

module.exports = Start;
