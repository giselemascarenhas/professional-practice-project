import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Agenda object
 */
async function getAgenda(id) {
  let sql = "SELECT A.AGENDA, A.TURNO, A.DISCIPLINA, D.NOME_COMPL NOME_DISCIPLINA, A.TURMA, A.ANO, A.NUM_FUNC," +
			"A.DATA, LEFT(RIGHT(A.HORA_INICIO,8),5) HORA_INICIO, LEFT(RIGHT(A.HORA_FIM,8),5) HORA_FIM FROM Agenda A " +
			"INNER JOIN Disciplina D ON D.DISCIPLINA = A.DISCIPLINA WHERE A.AGENDA = ?";
  const [rows] = await pool.query(sql, [id]);
  return rows[0];
}

/**
 * @description Get All Agenda
 * @route GET /Agenda
 */
export const getAllAgenda = tryCatchWrapper(async function (req, res, next) {
	let sql = "SELECT * from Agenda LIMIT 10";
	const [rows] = await pool.query(sql);
	if (!rows.length) return res.status(204).json({ message: "Não foram encontrados resultados" });
  
	return res.status(200).json({ Agenda: rows });
  });

/**
 * @description Get Agenda Prof
 * @route GET /agenda/:data/:prof
 * -- A.DATA = :data AND A.NUM_FUNC = :prof 
 */
export const getAgendaProf = tryCatchWrapper(async function (req, res, next) {
	const { data, prof } = req.params;
  
	const sql = `
	  SELECT 
	  		A.AGENDA, A.TURNO, A.DISCIPLINA, D.NOME_COMPL AS NOME_DISCIPLINA, A.TURMA, A.ANO, A.NUM_FUNC,
			A.DATA, LEFT(RIGHT(A.HORA_INICIO,8),5) AS HORA_INICIO, LEFT(RIGHT(A.HORA_FIM,8),5) AS HORA_FIM 
	  FROM 
	  		Agenda A 
	  		INNER JOIN Disciplina D ON D.DISCIPLINA = A.DISCIPLINA 
	  WHERE 
			A.DATA = ? AND A.NUM_FUNC = ?
	  ORDER BY 
	  		A.HORA_INICIO
	`;
  
	const [rows] = await pool.query(sql, [ data, prof ]);
  
	if (!rows.length) {
	  return res.status(204).json({ message: "Não foram encontrados resultados" });
	}
  
	return res.status(200).json({ Agenda: rows });
});

/**
 * @description Get Single Agenda
 * @route GET /agenda/:id
 */
export const getSingleAgenda = tryCatchWrapper(async function (req, res, next) {
	const { id } = req.params;
  
	const Agenda = await getAgenda(id);
	if (!Agenda) return next(createCustomError("Agenda não encontrada", 404));
  
	return res.status(200).json(Agenda);
  });