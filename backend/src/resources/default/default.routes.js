import express from "express";
import {
  getDefault
} from "./default.controllers.js";

const router = express.Router();

router.route("/").get(getDefault);

export default router;