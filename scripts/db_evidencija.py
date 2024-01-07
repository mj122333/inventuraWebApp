from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint, choice
import mysql.connector
from mysql.connector import Error
import pandas as pd
from datetime import datetime, timedelta

db = mysql.connector.connect(
    host="localhost", user="vito", password="micko", database="inventura"
)

cursor = db.cursor()

sql = "SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1"
cursor.execute(sql)
result = cursor.fetchall()
column_names = cursor.column_names
zadnja_inventura = result[0][column_names.index("id")]

print(f"Zadnja inventura ID: {zadnja_inventura}", flush=True)

proizvodi = list(range(211, 420 + 1))
ucionice = list(range(1, 10 + 1))
users = [2, 3, 6, 24, 26]

current_time = (
    (datetime.now() + timedelta(seconds=randint(-3600, 3600)))
    .time()
    .strftime("%H:%M:%S")
)
current_date = datetime.now().date()

for i in range(150):
    current_time = (
        (datetime.now() + timedelta(seconds=randint(-3600, 3600)))
        .time()
        .strftime("%H:%M:%S")
    )

    sql = f"INSERT INTO vl_evidencija (proizvod_id, ucionica_id, datum, vrijeme, user_id, inventura_id) VALUES (%s, %s, %s, %s, %s, %s)"
    values = (
        choice(proizvodi),
        choice(ucionice),
        current_date,
        current_time,
        choice(users),
        zadnja_inventura,
    )

    cursor.execute(sql, values)


db.commit()

cursor.close()
db.close()
