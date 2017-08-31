import json
import os
import string
import pycurl
import sys
from time import sleep
from pprint import pprint
from io import BytesIO
#pprint(next(os.walk('.'))[1])

rootdir = '.'

print("Starting Python Script.")
sys.stdout.flush()

# Set Slash, depending on Linux or Cygwin                
slash = "/"
print("Working Directory: " + os.getcwd());
if "\\" in os.getcwd():
    slash = "\\"
else:
    slash = "/"


#os.chdir(slash + "var" + slash + "www" + slash + "public_html" + slash + "data")
#os.chdir(slash + "var" + slash + "www" + slash + "public_html" + slash + "data")

#https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&dataById=true&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833

api_key = "RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3"

sys.stdout.flush()
#url = "https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&dataById=true&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"
url = "https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&dataById=true&api_key=" + api_key
buffer = BytesIO()
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd(), "champsList.json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd(), "champsList.json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got Champ List!")
sys.stdout.flush()      


sys.stdout.flush()
#Old key: 78f7f6d7-b181-4ea9-a792-487ec4417dee
#https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&dataById=true&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833
url = "https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&api_key=" + api_key
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd(), "champsListByName.json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd(), "champsListByName.json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got Champ List!")
sys.stdout.flush()


for root, dirs, files in os.walk(os.path.dirname(os.getcwd()) + slash + "datadragon"):
    for file in files:
        print(file)
        if file.endswith("champion.json") and root.endswith("en_US"):
            print(os.path.join(root, file))
            with open(os.path.join(root, file)) as data_file:    
                print(data_file)
                sys.stdout.flush()
                data = json.load(data_file)
                #print(data)
                data_file.close()

                
for champ in data['data']:
    #champName = str(champ.replace(" ", "").replace("'", ""))
    champName = str(data['data'][champ]['id'].replace(" ", "").replace("'", ""))
    print(champName)
    sys.stdout.flush()
    url = "http://api.champion.gg/champion/" + champName + "?api_key=41619a09cb6cbe21e7c399d7f7053993"
    c = pycurl.Curl()
    c.setopt(pycurl.URL, url)
    print(os.path.join(os.getcwd() + slash + "championgg", champName + ".json"))
    sys.stdout.flush()
    with open(os.path.join(os.getcwd() + slash + "championgg", champName + ".json"), 'w+') as f:
        print("Opened JSON.")
        sys.stdout.flush()                        
        c.setopt(c.WRITEDATA, buffer)
        c.perform()
        f.write(buffer.getvalue().decode('iso-8859-1'))
        buffer.truncate(0)
        buffer.seek(0)
        c.close()
        f.close()
    print("Got Champ: " + champ)
    sys.stdout.flush()
    sleep(.25)

    
champName = "MonkeyKing"
print(champName)
sys.stdout.flush()
url = "http://api.champion.gg/champion/" + champName + "?api_key=41619a09cb6cbe21e7c399d7f7053993"
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd() + slash + "championgg", champName + ".json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd() + slash + "championgg", champName + ".json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got Champ: " + champ)
sys.stdout.flush()         
                    
                
                

            
            
            
for champ in data['data']:
    #champName = str(champ.replace(" ", "").replace("'", ""))
    champName = str(data['data'][champ]['name'].replace(" ", "").replace("'", ""))
    print(champName)
    sys.stdout.flush()
    #http://api.champion.gg/champion/monkeyking/general?api_key=41619a09cb6cbe21e7c399d7f7053993
    url = "http://api.champion.gg/champion/" + champName + "/general?api_key=41619a09cb6cbe21e7c399d7f7053993"
    c = pycurl.Curl()
    c.setopt(pycurl.URL, url)
    print(os.path.join(os.getcwd() + slash + "championgg" + slash + "general", champName + ".json"))
    sys.stdout.flush()
    with open(os.path.join(os.getcwd() + slash + "championgg" + slash + "general", champName + ".json"), 'w+') as f:
        print("Opened JSON.")
        sys.stdout.flush()                        
        c.setopt(c.WRITEDATA, buffer)
        c.perform()
        f.write(buffer.getvalue().decode('iso-8859-1'))
        buffer.truncate(0)
        buffer.seek(0)
        c.close()
        f.close()
    print("Got Champ General: " + champ)
    sys.stdout.flush()
    sleep(.25)

    
champName = "MonkeyKing"
print(champName)
sys.stdout.flush()
url = "http://api.champion.gg/champion/" + champName + "/general?api_key=41619a09cb6cbe21e7c399d7f7053993"
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd() + slash + "championgg" + slash + "general", champName + ".json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd() + slash + "championgg" + slash + "general", champName + ".json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got Champ General: " + champ)
sys.stdout.flush()         




print("Getting All Champ Roles...")
sys.stdout.flush()
url = "http://api.champion.gg/champion?api_key=41619a09cb6cbe21e7c399d7f7053993"
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd() + slash + "championgg", "allChampRoles.json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd() + slash + "championgg", "allChampRoles.json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got All Champ Roles!")
sys.stdout.flush()    
                                
            
        
sys.stdout.flush()
#url = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=spells&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"
url = "https://na1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&tags=spells&api_key=" + api_key
c = pycurl.Curl()
c.setopt(pycurl.URL, url)
print(os.path.join(os.getcwd(), "champSpells.json"))
sys.stdout.flush()
with open(os.path.join(os.getcwd(), "champSpells.json"), 'w+') as f:
    print("Opened JSON.")
    sys.stdout.flush()                        
    c.setopt(c.WRITEDATA, buffer)
    c.perform()
    f.write(buffer.getvalue().decode('iso-8859-1'))
    buffer.truncate(0)
    buffer.seek(0)
    c.close()
    f.close()
print("Got Champ Spells!")
sys.stdout.flush()           


            
            
#for i in os.listdir('.'):
#    if i.find("dragontail") > -1: 
#        for j in os.listdir(i):
#            if j[0].isdigit():
#                pprint("Found Number: " + j)
#                continue
#            else:
#                continue            
#        pprint("Found " + i)
#        continue
#    else:
#        continue



#str.find(str, beg=0 end=len(string))

#with open('champions.json') as data_file:    
#    data = json.load(data_file)

#pprint(data)

#pprint(len(data["data"]))



#for x in range(0, len(data["data"]))
#    pprint(x)
