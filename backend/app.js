import express          from "express";
import dotenv           from "dotenv";
import { notFound }     from "./src/middlewares/notFound.js";
import { handleError }  from "./src/middlewares/handleError.js";
import agendaRoute      from "./src/resources/agenda/agenda.routes.js";
import alunoRoute       from "./src/resources/aluno/aluno.routes.js";
import faltaRoute       from "./src/resources/falta/faltas.routes.js";
import disciplinaRoute  from "./src/resources/disciplina/disciplina.routes.js";
import professorRoute   from "./src/resources/professor/professor.routes.js";
import turmaRoute       from "./src/resources/turma/turma.routes.js";
dotenv.config();

const app = express();
const port = process.env.PORT || 3000;

//middleware
app.use(express.json());

app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});

// api routes
app.use("/agenda",      agendaRoute);
app.use("/aluno",       alunoRoute);
app.use("/falta",       faltaRoute);
app.use("/disciplina",  disciplinaRoute);
app.use("/professor",   professorRoute);
app.use("/turma",       turmaRoute);

app.use(notFound);
app.use(handleError);

app.listen(port, () => {
  console.log(`Servidor sendo executado na porta ${port}`);
});
