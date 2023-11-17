import { executeQuery } from '../util/executeQuery';

const createList = async (user_id: number, list_name: string, list_desc: string) => {
    try {
        const query = "INSERT INTO lists_table (user_id, list_name, list_desc) VALUES (?,?,?)";
        const result = await executeQuery(query, [user_id, list_name, list_desc]);
        return result;
    } catch (error) {
       console.error('Creating list error at service: ', error);
       return error;
    }
}

const getList = async (user_id: number) => {
    try {
        const query = "SELECT * FROM lists_table WHERE user_id = ?";
        const result = await executeQuery(query,[user_id]);
        return result;
    } catch (error) {
       console.error('Getting list error at service: ', error);
       return error;
    }
}

export default {
    createList,
    getList,
}
