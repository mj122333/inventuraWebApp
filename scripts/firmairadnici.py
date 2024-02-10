from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint, choice, uniform
import mysql.connector
from mysql.connector import Error
import pandas as pd
from datetime import datetime, timedelta

imena = [
    "Ana",
    "Ivan",
    "Marija",
    "Marko",
    "Eva",
    "Petar",
    "Katarina",
    "Luka",
    "Sara",
    "Filip",
    "Mia",
    "Ante",
    "Dora",
    "Josip",
    "Iva",
    "Nikola",
    "Lana",
    "Stjepan",
    "Ema",
    "Matija",
    "Laura",
    "Tomislav",
    "Ana-Marija",
    "Ivan",
    "Magdalena",
    "Šime",
    "Lea",
    "Fran",
    "Tina",
    "Borna",
]

prezimena = [
    "Horvat",
    "Kovačević",
    "Babić",
    "Marić",
    "Pavić",
    "Jurić",
    "Krulj",
    "Luketić",
    "Blažević",
    "Bogdanović",
    "Vuković",
    "Knežević",
    "Marković",
    "Novak",
    "Kovačić",
    "Matijević",
    "Barišić",
    "Zoričić",
    "Šimić",
    "Ivančević",
    "Hrastić",
    "Petrović",
    "Križanac",
    "Bukovac",
    "Martinović",
    "Tomljanović",
    "Župan",
    "Rukavina",
    "Perić",
    "Čule",
]


def random_oib():
    oib = ""
    for i in range(11):
        oib += str(randint(1, 9))
    return oib


db = mysql.connector.connect(
    host="localhost", user="vito", password="micko", database="firmairadnici"
)

cursor = db.cursor()

# sql = "SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1"
# cursor.execute(sql)
# result = cursor.fetchall()
# column_names = cursor.column_names
# zadnja_inventura = result[0][column_names.index("id")]


# for i in range(20):
#     sql = f"insert into radnici (ime, prezime, oib, firma_id) values (%s, %s, %s, %s)"
#     values = (choice(imena), choice(prezimena), random_oib(), randint(1, 3))

#     cursor.execute(sql, values)

# for i in range(3):
#     sql = f'insert into firme (naziv) values ("{["TSC", "google", "apple"][i]}")'

#     cursor.execute(sql)

sql = "SELECT * from radnici"
cursor.execute(sql)
result = cursor.fetchall()
column_names = cursor.column_names
# zadnja_inventura = result[0][column_names.index("id")]

for radnik in result:
    radnik_id = radnik[column_names.index("id")]

    for i in range(4):
        vrijeme = (
            (datetime.now() + timedelta(days=i)).strftime("%Y-%m-%d")
            + " "
            + str(randint(7, 10)).rjust(2, "0")
            + ":00:00"
        )
        sql = f'insert into radno_vrijeme (radnik_id, vrijeme, dolazak) values ({radnik_id}, "{vrijeme}", 1)'
        cursor.execute(sql)

        vrijeme = (
            (datetime.now() + timedelta(days=i)).strftime("%Y-%m-%d")
            + " "
            + str(randint(14, 17)).rjust(2, "0")
            + ":00:00"
        )
        sql = f'insert into radno_vrijeme (radnik_id, vrijeme, dolazak) values ({radnik_id}, "{vrijeme}", 0)'
        cursor.execute(sql)


db.commit()

cursor.close()
db.close()
