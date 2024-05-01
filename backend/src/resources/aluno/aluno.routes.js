import express from "express";
import {
  getAllAluno,
  getSingleAluno,
} from "./aluno.controllers.js";

const router = express.Router();

router.route("/").get(getAllAluno);
router.route("/:id").get(getSingleAluno);

export default router;
