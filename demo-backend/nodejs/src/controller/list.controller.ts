import listService from '../service/list.service';
import { Request, Response } from 'express';

const createList = async (req: Request, res: Response) => {
    try {
        const { user_id, list_name, list_desc } = req.body;
        const result = await listService.createList(user_id, list_name, list_desc);
        return res.status(200).json({ message: "List created successfully", status: 201 });
    } catch (error) {
       console.error("Creating list error at controller: ",error);
       return res.status(500).json(error)
    }
}

const getList = async (req: Request, res: Response) => {
    try {
        const { user_id } = req.body;
        const result = await listService.getList(user_id);
        return res.status(200).json(result);
    } catch (error) {
       console.error("Getting list error at controller: ", error);
       return res.status(500).json(error);
    }
}

export default {
    createList,
    getList,
}
