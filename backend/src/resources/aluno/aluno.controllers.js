 import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Aluno object
 */
async function getAluno(id) {
  let sql = "SELECT * FROM Aluno WHERE ALUNO_ID = ?";
  const [rows] = await pool.query(sql, [id]);
  return rows[0];
}

/**
 * @description Get All Aluno
 * @route GET /Aluno
 */
export const getAllAluno = tryCatchWrapper(async function (req, res, next) {
  let sql = "SELECT * from Aluno";
  const [rows] = await pool.query(sql);
  if (!rows.length) return res.status(204).json({ message: "Não foram encontrados resultados" });

  return res.status(200).json({ Aluno: rows });
});

/**
 * @description Get Single Aluno
 * @route GET /Aluno/:id
 */
export const getSingleAluno = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;

  const Aluno = await getAluno(id);
  if (!Aluno) return next(createCustomError("Aluno não encontrado", 404));

  return res.status(200).json(Aluno);
});