from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint
import mysql.connector
from mysql.connector import Error
import pandas as pd

db = mysql.connector.connect(
    host="localhost",
    user="vito",
    password="micko",
    database="inventura"
)

cursor = db.cursor()

sql = "SELECT * FROM test"
cursor.execute(sql)
result = cursor.fetchall()
column_names = cursor.column_names

for row in result:
    ID = row[column_names.index('id')]
    code = EAN13(ID, writer=ImageWriter())
    code.save("code_{}".format(ID))

db.commit()

cursor.close()
db.close()
