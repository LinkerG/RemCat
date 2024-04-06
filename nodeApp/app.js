const mongoose = require('mongoose');
import express from "express";
const router = express.Router();
const path = require('path');
const port = 3000;

mongoose.connect('mongodb://root:chocu@localhost:27017/RemCat');

const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Error de conexión a la base de datos:'));
db.once('open', () => {
  console.log('Conexión exitosa a la base de datos MongoDB');
});

//ROUTES
router.get('/', (req, res) => {
  res.render('start', { title: 'Página de inicio' });
});

// Definir el modelo fuera del controlador de ruta
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

// Define un objeto para mapear los nombres de colecciones a modelos
const collectionModels = {};

// Función para obtener o definir un modelo basado en el nombre de la colección
const getModelForCollection = (collectionName) => {
  // Si ya tenemos un modelo para esta colección, devolverlo
  if (collectionModels[collectionName]) {
      return collectionModels[collectionName];
  }
  // Si no, definir y guardar el modelo
  return collectionModels[collectionName] = mongoose.model(collectionName, CompetitionResultSchema);
};

// Ruta de manejo
router.get('/generateQR/:collection/:_id', async (req, res) => {
  const { collection, competition_id } = req.params;
  
  // Obtener el modelo según el nombre de la colección
  const CollectionModel = getModelForCollection(collection);

  try {
      // Realizar la consulta utilizando el modelo obtenido
      const results = await CollectionModel.find({ competition_id: competition_id }).exec();
      res.render("generateQR", { competitionResults: results });
  } catch (error) {
      console.error('Error al realizar la consulta:', error);
      res.status(500).send('Error al obtener los resultados');
  }
});


router.use(express.static('public'));

router.use((req, res, next) => {
  res.status(404).send("Lo siento, no puedo encontrar esa página.");
});

router.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Algo salió mal!');
});

router.listen(port, (err) => {  
  if (err) {
    return console.log('¡Error al arrancar!', err);
  }

  console.log(`¡El servidor está escuchando en el puerto ${port}!`);
});
