 import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Professor object
 */
async function getProfessor(id) {
  let sql = "SELECT * FROM Professor WHERE NUM_FUNC = ?";
  const [rows] = await pool.query(sql, [id]);
  return rows[0];
}

/**
 * @description Get All Professor
 * @route GET /Professor
 */
export const getAllProfessor = tryCatchWrapper(async function (req, res, next) {
  let sql = "SELECT * from Professor";
  const [rows] = await pool.query(sql);
  if (!rows.length) return res.status(204).json({ message: "Não foram encontrados resultados" });

  return res.status(200).json({ Professor: rows });
});

/**
 * @description Get Single Professor
 * @route GET /Professor/:id
 */
export const getSingleProfessor = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;

  const Professor = await getProfessor(id);
  if (!Professor) return next(createCustomError("Professor não encontrado", 404));

  return res.status(200).json(Professor);
});