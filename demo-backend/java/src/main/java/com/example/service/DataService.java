package com.example.service;

import com.example.config.MySQLConfig;
import com.example.model.DataModel;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class DataService {
    public DataModel getData(String key) {
        try (Connection connection = DriverManager.getConnection(MySQLConfig.getDatabaseUrl(), MySQLConfig.getUsername(), MySQLConfig.getPassword())) {
            String query = "SELECT * FROM demo_table WHERE key_column = ?";
            try (PreparedStatement preparedStatement = connection.preparedStatement(query)) {
                preparedStatement.setString(1, key);
                try (ResultSet resultSet = preparedStatement.executeQuery()) {
                    if (resultSet.next()) {
                        DataModel dataModel = new DataModel();
                        dataModel.setData(resultSet.getString("data"));
                        return dataModel;
                    }
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void createData(String key, String value) {
        try (Connection connection = DriverManager.getConnection(MySQLConfig.getDatabaseUrl(), MySQLConfig.getUsername(), MySQLConfig.getPassword())) {
            String query = "INSERT INTO demo_table (key_column, data) VALUES (?,?)";
            try (PreparedStatement preparedStatement = connection.preparedStatement(query)) {
                preparedStatement.setString(1, key);
                preparedStatement.setString(2, value);
                preparedStatement.executeUpdate();
                return "";
            } catch (SQLException e) {
                e.printStackTrace();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void updateData(String key, String value) {
        try (Connection connection = DriverManager.getConnection(MySQLConfig.getDatabaseUrl(), MySQLConfig.getUsername(), MySQLConfig.getPassword())) {
            String query = "UPDATE demo_table SET data = ? WHERE key_column = ?";
            try (PreparedStatement preparedStatement = connection.preparedStatement(query)) {
                preparedStatement.setString(1, value);
                preparedStatement.setString(2, key);
                preparedStatement.executeUpdate();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void deleteData(String key) {
        try (Connection connection = DriverManager.getConnection(MySQLConfig.getDatabaseUrl(), MySQLConfig.getUsername(), MySQLConfig.getPassword())) {
            String query = "DELETE FROM demo_table WHERE key_column = ?";
            try (PreparedStatement preparedStatement = connection.preparedStatement(query)) {
                preparedStatement.setString(1, key);
                preparedStatement.executeUpdate();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
