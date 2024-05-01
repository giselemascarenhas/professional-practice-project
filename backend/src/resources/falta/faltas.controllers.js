import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Falta object
 */
async function getFalta(id) {
  let sql = "SELECT * FROM Falta WHERE FALTA_ID = ?";
  const [rows] = await pool.query(sql, [id]);
  return rows[0];
}

/**
 * @description Get All Falta
 * @route GET /Falta
 */
export const getAllFalta = tryCatchWrapper(async function (req, res, next) {
  let sql = "SELECT * from Falta";
  const [rows] = await pool.query(sql);
  if (!rows.length) return res.status(204).json({ message: "Não foram encontrados resultados" });

  return res.status(200).json({ Falta: rows });
});

/**
 * @description Get Single Falta
 * @route GET /Falta/:id
 */
export const getSingleFalta = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;

  const Falta = await getFalta(id);
  if (!Falta) return next(createCustomError("Falta não encontrada", 404));

  return res.status(200).json(Falta);
});

/**
 * @description Create Falta
 * @route POST /Falta
 */
export const createFalta = tryCatchWrapper(async function (req, res, next) {
const { AGENDA_ID, ALUNO, USUARIO_ID } = req.body;

  if ( !AGENDA_ID || !ALUNO  || !USUARIO_ID )
    return next(createCustomError("Todos os campos são necessários", 400));

  let sql = "INSERT INTO Falta (AGENDA, ALUNO_ID, USUARIO_ID, DATA_CAD) VALUES (?, ?, ?, NOW() )";
  await pool.query(sql, [AGENDA_ID, ALUNO, USUARIO_ID]);

  let sql1 = "SELECT FALTA_ID FROM Falta WHERE AGENDA = ? AND ALUNO_ID = ?";
  const [rows] = await pool.query(sql1, [AGENDA_ID, ALUNO]);

  return res.status(200).json({ Falta: rows });
});

/**
 * @description Update Falta
 * @route PATCH /Falta/:id
 */
export const updateFalta = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;
  // const { title, contents } = req.body;
  const { AGENDA_ID, ALUNO, USUARIO_ID } = req.body;

  if (!id || !AGENDA_ID || !ALUNO || !USUARIO_ID )
    return next(createCustomError("Todos os campos são necessários", 400));

  const Falta = await getFalta(id);
  if (!Falta) return next(createCustomError("Falta não encontrada", 404));

  let sql = "UPDATE Falta SET AGENDA_ID = ? , ALUNO = ? , USUARIO_ID = ? WHERE FALTA_ID = ?";
  await pool.query(sql, [title, contents, id]);

  return res.status(201).json({ message: "Falta foi atualizada" });
});

/**
 * @description Delete Falta
 * @route DELETE /Falta/:id
 */
export const deleteFalta = tryCatchWrapper(async function (req, res, next) {
  const { id } = req.params;

  if (!id) return next(createCustomError("Id é necessário", 400));

  const Falta = await getFalta(id);
  if (!Falta) return next(createCustomError("Falta não encontrada", 404));

  let sql = "DELETE FROM Falta WHERE FALTA_ID = ?";
  await pool.query(sql, [id]);

  return res.status(200).json({ message: "Falta foi excluída" });
});
