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

sql = "SELECT * FROM vl_ucionice"
cursor.execute(sql)
ucionice = cursor.fetchall()

sql = "SELECT * FROM vl_proizvodi"
cursor.execute(sql)
result = cursor.fetchall()
column_names = cursor.column_names

# for i in result:
#     proizvod_id = i[column_names.index("id")]
#     ucionica_id = choice(ucionice)[0]
#     kolicina = randint(1, 30)

#     sql = f"insert into vl_stanje (proizvod_id, ucionica_id, kolicina) values ({proizvod_id}, {ucionica_id}, {kolicina})"
#     values = ()
#     cursor.execute(sql)


db.commit()

cursor.close()
db.close()
