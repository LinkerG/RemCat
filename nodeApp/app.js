const express = require('express');
const app = express();
const path = require('path');
const port = 3000;

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jsx');
app.engine('jsx', require('express-react-views').createEngine());

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', (req, res) => {
  res.render('start', { title: 'Página de inicio' });
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
    return console.log('¡Algo malo sucedió!', err);
  }

  console.log(`¡El servidor está escuchando en el puerto ${port}!`);
});
