const mongoose = require('mongoose');
const express = require('express');
const app = express();
const path = require('path');
const port = 3000;

mongoose.connect('mongodb://mongodb:27017/RemCat', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

const CompetitionResultSchema = new mongoose.Schema({
  competition_id: String,
  teamName: String,
  category: String,
  teamMembers: [String],
  insurance: String,
  distance: String,
  time: String,
  isLive: Boolean,
  updated_at: { type: Date, default: Date.now },
  created_at: { type: Date, default: Date.now }
});

const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Error de conexión a la base de datos:'));
db.once('open', () => {
  console.log('Conexión exitosa a la base de datos MongoDB');
});

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jsx');
app.engine('jsx', require('express-react-views').createEngine());

app.use(express.static(path.join(__dirname, 'public')));

//ROUTES
app.get('/', (req, res) => {
  res.render('start', { title: 'Página de inicio' });
});

app.get('/generateQR/:collection/:_id', (req, res) => {
  const { collection, competition_id } = req.params;

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
