package com.example.config;

import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

public class MySQLConfig {
    private static final Properties properties = new Properties();

    static {
        try (InputStream input = MySQLConfig.class.getClassLoader().getResourceAsStream("config/mysql.properties")) {
            if (input == null) {
                System.out.println("Error unable to find mysql.properties");
                return;
            }

            // Load a properties file from class path
            properties.load(input);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static String getDatabaseUrl() {
        return properties.getProperty("database.url");
    }

    ppublic static String getUsername() {
        return properties.getProperty("database.username");
    }

    public static String getPassword() {
        return properties.getProperty("database.password");
    }
}
