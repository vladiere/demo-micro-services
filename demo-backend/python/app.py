import asyncio
from flask import Flask, request, jsonify
from flask_bcrypt import Bcrypt
from flask_jwt_extended import JWTManager, create_access_token
from flask_mysqldb import MySQL
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
bcrypt = Bcrypt(app)
mysql = MySQL(app)
jwt = JWTManager(app)

app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = '31N$t31n'
app.config['MYSQL_DB'] = 'demoipt'
app.config['JWT_SECRET_KEY'] = 'demipt_secret_key'

async def execute_query(query, data=None):
    try:
        cur = mysql.connection.cursor()
        if data:
            cur.execute(query, data)
        else:
            cur.execute(query)
        result = cur.fetchall()
        mysql.connection.commit()
        cur.close()
        return result
    except Exception as e:
        raise e

async def login_async(data):
    query = "SELECT * FROM users_table WHERE username = %s"
    result = await execute_query(query, (data['username'],))

    if result:
        if bcrypt.check_password_hash(result[0][2].encode('utf-8'), data['password'].encode('utf-8')):
            token = create_access_token(identity={'username': result[0][1], 'user_id': result[0][0]})
            return jsonify(token=token), 200
        else:
            return jsonify({ "message" : "Invalid password", "status": 401 }), 201
    else:
        return jsonify({ "message" : "Invalid username", "status": 401 }), 201


async def register_async(data):
    hashed_password = bcrypt.generate_password_hash(data['password']).decode('utf-8')
    query = "INSERT INTO users_table (username, password) VALUES (%s,%s)"
    await execute_query(query, (data['username'], hashed_password))

@app.route('/api/register', methods=['POST'])
def register():
    try:
        data = request.get_json()
        asyncio.run(register_async(data))
        return jsonify({ "message" : "User registered successfully", "status": 201}), 201
    except Exception as e:
        return jsonify({ "message": f"An error occured: {str(e)}"}), 500

@app.route('/api/login', methods=['POST'])
def login():
    try:
        data = request.get_json()
        token = asyncio.run(login_async(data))
        return token
    except Exception as e:
        return jsonify({ "message" : f"An error occured: {str(e)}" }), 500


if __name__ == '__main__':
    app.run(debug=True)

