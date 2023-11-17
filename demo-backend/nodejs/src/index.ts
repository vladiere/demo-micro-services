import path from 'path';
import { Server as HTTPServer } from 'http';
import express, { Express } from 'express';
import cors from 'cors';
import bodyParser from 'body-parser';
import listRoute from './route/list.route';

const app: Express = express();
const PORT: number = Number(process.env.PORT) | 1337;
const httpServer = new HTTPServer(app);

app.use(express.urlencoded({ extended: false }));
app.use(express.json());
app.use(bodyParser.json());
app.use(cors());

app.use(express.static(path.join(__dirname, 'public')));

app.use('/api/', listRoute);

app.use((req, res, next) => {
  const error = new Error("Not Found");
  return res.status(404).json({
    message: error.message,
  });
});

httpServer.listen(PORT, () => {
    console.info(`Server running on PORT: ${PORT}`);
})
