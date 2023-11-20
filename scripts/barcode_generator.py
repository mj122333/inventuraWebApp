from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint
import mysql.connector
from mysql.connector import Error
import pandas as pd

folder_path = "public/barcodes/"

db = mysql.connector.connect(
    host="localhost", user="vito", password="micko", database="inventura"
)

cursor = db.cursor()

sql = "SELECT * FROM proizvodi"
cursor.execute(sql)
result = cursor.fetchall()
column_names = cursor.column_names

for row in result:
    ID = row[column_names.index("id")]
    tip = row[column_names.index("tip")]

    data = EAN13("00" + str(tip).rjust(4, "0") + str(ID).rjust(6, "0")) # [00]{0 000} {000 000}

    sql = f"INSERT INTO barkodovi (proizvod_id, barkod) VALUES ({ID}, '{data}')"
    cursor.execute(sql)

    # code = EAN13(data, writer=ImageWriter())
    # code.save(folder_path + "code_{}".format(data))
    # break

db.commit()

cursor.close()
db.close()
