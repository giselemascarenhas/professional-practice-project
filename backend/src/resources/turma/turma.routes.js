import express from "express";
import {
  getAllTurmas,
  getSingleTurma,
} from "./turma.controllers.js";

const router = express.Router();

router.route("/").get(getAllTurmas);
router.route("/:id").get(getSingleTurma);

export default router;