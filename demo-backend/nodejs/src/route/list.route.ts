import { Router } from "express";
import listController from '../controller/list.controller';

const router = Router();

router.post('/list/create', listController.createList);
router.post('/list/get', listController.getList);

export default router;
