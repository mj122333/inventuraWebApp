from barcode import EAN13
from barcode.writer import ImageWriter
from random import randint

for i in range(1):
    number = randint(1000000000000, 9999999999999)
    code = EAN13(str(number), writer=ImageWriter())

    code.save("new_code{}".format(i))
