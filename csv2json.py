import csv
import json

data = []
with open("projects.json", "w") as fout:
    with open("cities.csv") as fin:
        dr = csv.DictReader(fin)
        for row in dr:
            data.append(row)
        json.dump(data, fout)
