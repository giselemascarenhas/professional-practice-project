import express from "express";
import {
  getAllProfessor,
  getSingleProfessor,
} from "./professor.controllers.js";

const router = express.Router();

router.route("/").get(getAllProfessor);
router.route("/:id").get(getSingleProfessor);

export default router;
