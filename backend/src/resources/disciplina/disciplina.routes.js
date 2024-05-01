import express from "express";
import {
  getAllDisciplina,
  getDisciplinasAtivas,
  getSingleDisciplina,
} from "./disciplina.controllers.js";

const router = express.Router();

router.route("/").get(getAllDisciplina);
router.route("/ativas").get(getDisciplinasAtivas);
router.route("/:id").get(getSingleDisciplina);

export default router;