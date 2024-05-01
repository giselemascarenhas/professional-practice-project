import express from "express";
import {
  getAllAgenda,
  getSingleAgenda,
  getAgendaProf,
} from "./agenda.controllers.js";

const router = express.Router();

router.route("/").get(getAllAgenda);
router.route("/:id").get(getSingleAgenda);
router.route("/:data/:prof").get(getAgendaProf);

export default router;