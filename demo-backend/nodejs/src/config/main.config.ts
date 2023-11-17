import dotenv from "dotenv";
import path from "path";

dotenv.config();

// MySQL database
const MYSQL_HOST = process.env.MYSQLHOST || "localhost";
const MYSQL_USER = process.env.MYSQLUSER || "root";
const MYSQL_PASS = process.env.MYSQLPASSWORD || "";
const MYSQL_DATABASE = process.env.MYSQLDATABASE || "cpclibrary";

const MYSQL = {
  host: MYSQL_HOST,
  database: MYSQL_DATABASE,
  user: MYSQL_USER,
  pass: MYSQL_PASS,
};

const SERVER_HOST = process.env.HOST || "localhost";
const SERVER_PORT = process.env.MYSQLPORT || 1337;

const MYSQL_URL = `mysql://${MYSQL_USER}:${MYSQL_PASS}@${MYSQL_HOST}:${SERVER_PORT}/${MYSQL_DATABASE}`

const SERVER = {
  hostname: SERVER_HOST,
  port: SERVER_PORT,
};

const config = {
  mysql: MYSQL,
  server: SERVER,
  imgDir: path.join(__dirname, "../public/images"),
  mysqlurl: MYSQL_URL
};

export default config;
