import express from "express";
import {
  createFalta,
  deleteFalta,
  getAllFalta,
  getSingleFalta,
  updateFalta,
} from "./faltas.controllers.js";

const router = express.Router();

router.route("/").get(getAllFalta).post(createFalta);
router.route("/:id").get(getSingleFalta).patch(updateFalta).delete(deleteFalta);

export default router;
