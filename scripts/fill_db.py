from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint, choice
import mysql.connector
from mysql.connector import Error
import pandas as pd

folder_path = "barcodes/"

db = mysql.connector.connect(
    host="localhost", user="vito", password="micko", database="inventura"
)

tipovi = [
    "stolac",
    "laptop",
    "monitor",
    "tipkovnica",
    "miš",
    "računalo",
    "projektor",
    "HDMI kabel",
    "pisač",
    "skener",
    "slušalice",
    "podloga za miš",
    "stol",
    "web kamera",
]

brendovi = {
    "stolac": ["Ikea", "Herman Miller", "Steelcase", "Secretlab", "DXRacer"],
    "laptop": ["Dell", "HP", "Lenovo", "Asus", "Apple"],
    "monitor": ["Dell", "Samsung", "LG", "Asus", "Acer"],
    "tipkovnica": ["Logitech", "Corsair", "Razer", "SteelSeries", "Microsoft"],
    "miš": ["Logitech", "Razer", "SteelSeries", "Microsoft", "Corsair"],
    "računalo": ["Dell", "HP", "Lenovo", "Apple", "Asus"],
    "projektor": ["Epson", "Sony", "BenQ", "Acer", "Optoma"],
    "HDMI kabel": ["AmazonBasics", "Belkin", "UGREEN", "Monoprice", "Anker"],
    "pisač": ["HP", "Canon", "Epson", "Brother", "Samsung"],
    "skener": ["Epson", "Canon", "Fujitsu", "HP", "Brother"],
    "slušalice": ["Sony", "Bose", "Sennheiser", "SteelSeries", "Audio-Technica"],
    "podloga za miš": ["Logitech", "SteelSeries", "Corsair", "Razer", "HyperX"],
    "stol": ["Ikea", "Bush Furniture", "Sauder", "Walker Edison", "Arozzi"],
    "web kamera": ["Logitech", "Microsoft", "Razer", "AverMedia", "HP"],
}


cursor = db.cursor()

# TIPOVI
# for tip in tipovi:
#     sql = f"INSERT INTO tipovi_proizvoda (tip) VALUES ('{tip}')"
#     cursor.execute(sql)


# PROIZVODI
# for tip in tipovi:
#     for i in range(15):
#         brend = choice(brendovi[tip])

#         sql = f"SELECT id FROM tipovi_proizvoda WHERE tip='{tip}'"
#         cursor.execute(sql)
#         tip_id = cursor.fetchone()[0]

#         sql = f"INSERT INTO proizvodi (tip, naziv, opis) VALUES ('{tip_id}', '{brend} {tip}', 'NEMA')"
#         cursor.execute(sql)


# BARKODOVI


db.commit()

cursor.close()
db.close()
