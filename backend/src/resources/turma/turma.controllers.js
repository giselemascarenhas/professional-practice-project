import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Turmas object
 */
async function getTurma(id) {
  let sql = "SELECT DISTINCT UNIDADE_FISICA, DISCIPLINA, ANO, NUM_FUNC, TURNO, CURSO, SERIE, DT_INICIO, DT_FIM FROM Turmas WHERE DISCIPLINA = ?";
  const [rows] = await pool.query(sql, [id]);
  return rows[0];
}

/**
 * @description Get All Turmas
 * @route GET /Turmas
 */
export const getAllTurmas = tryCatchWrapper(async function (req, res, next) {
  let sql = "SELECT TURMA, CURSO, SERIE, COUNT(ALUNO_ID) QTD FROM AlunosTurma GROUP BY TURMA ORDER BY TURMA";
  const [rows] = await pool.query(sql);
  if (!rows.length) return res.status(204).json({ message: "Não foram encontrados resultados" });

  return res.status(200).json({ Turmas: rows });
});

/**
 * @description Get Single Turmas
 * @route GET /Turmas/:id
 */
export const getSingleTurma = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;

  const Turmas = await getTurma(id);
  if (!Turmas) return next(createCustomError("Turma não encontrada", 404));

  return res.status(200).json(Turmas);
});