import re
import requests
from bs4 import BeautifulSoup
from person import Person 
import unittest


searched=[]
def check(func):
    def wrapper(username):
        if type(username).__name__ !='str':
            raise ValueError("Input is not string")

        if username.find(r"[/_{}'/%^&*@#! ]") is not -1 :
            raise Exception("Invalid username")
        
        global searched
        found = False
        for x in searched:
            if x[1] == username:
                x[0].show()
                found=True
        if found is not True:
                func(username)
    return wrapper


@check
def scrape(username):
    url = f"https://www.facebook.com/{username}"
    page = requests.get(url)       
    soup = BeautifulSoup(page.text,'html.parser')
    namediv = soup.find(id = "fb-timeline-cover-name")

    if namediv is None:
        raise Exception("User non existent")

    name = namediv.find('a').get_text()
    if soup.find(class_="_2iel _50f7") is not None:
        currentCity = soup.find(class_="_2iel _50f7").get_text()
    favorites = soup.find(id = "favorites")

    if favorites != None:
        keys = [x.get_text() for x in favorites.find_all(class_='labelContainer')]
        values = [x.get_text() for x in favorites.find_all(class_='mediaPageName')]
        favourite_dict = dict(zip(keys,values))
        try:
            others = favorites.find(class_='visible').find_all('a')
        except Exception:
            print("Inhe kuch pasand nahi!!XD")
        else:
            favourite_dict['other'] = [x.get_text() for x in others]
            print(f"Likes {favourite_dict}")

    workdiv = soup.find(class_="uiList")
    if workdiv is not None:
        try:
            works = workdiv.find_all(class_="fsm fwn fcg")
            worklist = [work.get_text().split(" · ")[0] for work in works]
        except Exception:
            print("Berozgaar")
        else:
            if worklist is not None and currentCity is not None:
                person = Person(name,currentCity,worklist)
            else:
                if currentCity is not None:
                    person = Person(name,currentCity)      
                else:
                    person = Person(name)
                    person.work = worklist
    
    global searched
    person.show()
    searched.append((person,username))



if(__name__ == "__main__"):
        # scrape("swapnil.negi09")
        # scrape("swapnil.negi09")
        scrape("swapnil.negi09")
        # abcrape("sc")
       