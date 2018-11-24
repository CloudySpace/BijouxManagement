from flask import Flask, session, redirect, url_for, escape, request, render_template
from hashlib import md5
import pymysql

app = Flask(__name__)

if __name__ == '__main__':
    db = pymysql.connect(host="localhost", user="root", passwd="", db="joyeria")
    cur = db.cursor()
    app.secret_key = 'A0Zr98j/3yX R~XHH!jmN]LWX/,?RT'

class ServerError(Exception):pass
@app.route('/', methods=['GET', 'POST'])
def login():
    if 'username' in session:
        return redirect(url_for('index'))

    error = None
    try:
        if request.method == 'POST':
            username_form  = request.form['username']
            cur.execute("SELECT COUNT(1) FROM empleado WHERE name = {};"
                        .format(username_form))

            if not cur.fetchone()[0]:
                raise ServerError('Invalid username')

            password_form  = request.form['password']
            cur.execute("SELECT pass FROM empleado WHERE name = {};"
                        .format(username_form))

            for row in cur.fetchall():
                if md5(password_form).hexdigest() == row[0]:
                    session['username'] = request.form['username']
                    return redirect(url_for('index'))

            raise ServerError('Invalid password')
    except ServerError as e:
        error = str(e)

    return render_template('login.html', error=error)

@app.route('/index')
def index():
    if 'username' in session:
        return redirect(url_for('index'))
        
    username_session = escape(session['username']).capitalize()
    return render_template('login.html', session_user_name=username_session)



@app.route('/logout')
def logout():
    session.pop('username', None)
    return redirect(url_for('login'))

if __name__ == '__main__':
    app.run(debug=True)