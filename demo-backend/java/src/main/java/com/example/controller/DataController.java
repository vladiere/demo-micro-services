package controller;

import model.DataModel;
import service.DataService;

public class DataController {
    private final DataService dataService;

    public DataController (DataService dataService) {
        this.dataService = dataService;
    }

    public String handleGet(String key) {
        DataModel dataModel = dataService.getData(key);
        return (dataModel != null) ? dataModel.getData() : null;
    }

    public void handlePost(String key, String value) {
        dataService.createData(key, value);
    }

    public void handlePut(String key, String value) {
       dataService.updateData(key, value);
    }

    public void handleDelete(String key) {
        dataService.deleteData(key);
    }
}
