import base64
import csv
import json
import os
from urllib.parse import quote


with open("cities.csv") as fin:
    dr = csv.DictReader(fin)
    for row in dr:
        if row['generate'] == '1':
            p = base64.b64encode(bytes(json.dumps(row), "utf-8"))
            command = "chromium-browser --headless --disable-gpu --screenshot --hide-scrollbars --window-size=1280,450 --save-to-png=q50.png http://localhost/michal/dev/projekty.kohovolit.eu/image.php?p=" + quote(p)
            print(command)
            os.system(command)
            command = "convert screenshot.png screenshot.jpg"
            os.system(command)
            command = "cp screenshot.jpg headers/1280x450/" + row['code'] + ".jpg"
            os.system(command)
            command = "convert -resize 270x headers/1280x450/" + row['code'] + ".jpg headers/270x95/" + row['code'] + '.jpg'
            os.system(command)
