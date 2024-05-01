import { pool } from "../../db/connect.js";
import { createCustomError } from "../../errors/customErrors.js";
import { tryCatchWrapper } from "../../middlewares/tryCatchWrapper.js";

/**
 * @returns Default object
 */
async function getDefault() {
	return next("<h2>SchoolFreq API</h2><br>API para consultas ", 200 );
}