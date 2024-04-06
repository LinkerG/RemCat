const mongoose = require('mongoose');
const express = require('express');
const app = express();
const path = require('path');
const port = 3000;

// MODELOS
const CompetitionResult = require('./models/CompetitionResult');
//CONEXION
mongoose.connect('mongodb://localhost:27017/nombre_de_tu_base_de_datos', { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => console.log('Conexión a la base de datos establecida'))
  .catch((error) => console.error('Error al conectar a la base de datos:', error));


app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jsx');
app.engine('jsx', require('express-react-views').createEngine());

app.use(express.static(path.join(__dirname, 'public')));

//ROUTES
app.get('/', (req, res) => {
  res.render('start', { title: 'Página de inicio' });
});

app.get('/generateQR/:collection/:_id', (req, res) => {
  const { collection, _id } = req.params;

  const CollectionModel = mongoose.model(collection, CompetitionResult.schema, collection);
  CollectionModel.find({ competition_id: competition_id }, (err, results) => {
    if (err) {
      console.error('Error al realizar la consulta:', err);
      return res.status(500).send('Error al obtener los resultados');
    }

    res.render("generateQR", { competitionResults: results });
  });
});

app.use(express.static('public'));

app.use((req, res, next) => {
  res.status(404).send("Lo siento, no puedo encontrar esa página.");
});

app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Algo salió mal!');
});

app.listen(port, (err) => {  
  if (err) {
    return console.log('¡Error al arrancar!', err);
  }

  console.log(`¡El servidor está escuchando en el puerto ${port}!`);
});
