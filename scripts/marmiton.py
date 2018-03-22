# encoding=utf8
import sys
from bs4 import BeautifulSoup
import requests
import codecs
import re
from time import gmtime, strftime
import MySQLdb

reload(sys)
sys.setdefaultencoding('utf8')

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="root",         # your username
                     passwd="root",  # your password
                     db="recipes")        # name of the data base

def clearString(str):
    return " ".join(str.split())


def slugify(s):
    s = s.lower()
    for c in [' ', '-', '.', '/']:
        s = s.replace(c, '_')
    s = re.sub('\W', '', s)
    s = s.replace('_', ' ')
    s = re.sub('\s+', ' ', s)
    s = s.strip()
    s = s.replace(' ', '-')

    return s

if len(sys.argv) != 2:
    print ("usage : python marmiton.py http://www.marmiton.org/recettes...")

if not sys.argv[1].startswith('http://www.marmiton.org/recettes/'):
    print ("It's note a recipe")
    sys.exit(0)

print ("Scanning " + sys.argv[1] + "...")

page = requests.get(sys.argv[1])
soup = BeautifulSoup(page.content, "lxml")

name = soup.find("h1", {"class": "main-title"})
print ("Name : " + name.text)

rating = soup.find("span", {"class": "recipe-reviews-list__review__head__infos__rating__value"})
print ("Rating : " + rating.text)

total_time = soup.find("span", {"class": "title-2 recipe-infos__total-time__value"})
print ("Total Time : " + total_time.text)

quantity = soup.find("span", {"class": "title-2 recipe-infos__quantity__value"})
print ("Quantity : " + quantity.text)

preparation_time = soup.find("div", {"class": "recipe-infos__timmings__preparation"})
if preparation_time:
    preparation_time = clearString(preparation_time.find("span", {"class": "recipe-infos__timmings__value"}).text)
print ("preparation_time : " + preparation_time)

cooking_time = soup.find("div", {"class": "recipe-infos__timmings__cooking"})
if cooking_time:
    cooking_time = clearString(cooking_time.find("span", {"class": "recipe-infos__timmings__value"}).text)
print ("cooking_time : " + cooking_time)

steps_data = []
steps = soup.findAll("li", {"class": "recipe-preparation__list__item"})
for step in steps:
    steps_data.append(clearString(step.find("h3").next_sibling))

print ("Steps :")
print (steps_data)

ingredients_data = []
ingredients = soup.findAll("li", {"class": "recipe-ingredients__list__item"})
for ingredient in ingredients:
    ingredient_data = {"quantity": 0, "name" : ""}
    ingredient_data["quantity"] = ingredient.find("span", {"class" : "recipe-ingredient-qt"}).text
    ingredient_data["name"] = ingredient.find("p", {"class" : "name_singular"})["data-name-singular"]
    ingredients_data.append(ingredient_data)

print ("Ingredients :")
print (ingredients_data)

comment = sys.argv[1] + "\n"
for ingredient in ingredients_data:
    comment += ingredient["quantity"] + " " + ingredient["name"] + "\n"

cur = db.cursor()

# Insert the new recipe
cur.execute("INSERT INTO recipe (name, description, cook_time, preparation_time, for_person, note, created_at, updated_at, slug) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", (name.text, comment, cooking_time, preparation_time, quantity.text, rating.text, strftime("%Y-%m-%d %H:%M:%S", gmtime()), strftime("%Y-%m-%d %H:%M:%S", gmtime()), slugify(name.text)))
db.commit()

# Get id of the new recipe
sql = "SELECT id FROM recipe WHERE slug LIKE '%s'" % (slugify(name.text))
cur.execute(sql)
results = cur.fetchone()
for row in results:
    recipe_id = row

print (recipe_id)

i = 1
for step in steps_data:
    cur.execute("INSERT INTO step (recipe_id, text, position) VALUES (%s, %s, %s)", (recipe_id, step, i))
    ++i
    print (step)
db.commit()
db.close()
