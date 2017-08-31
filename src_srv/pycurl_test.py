import pycurl, json
from io import BytesIO

region = "na1"

gameId = 2584002015

api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'

myUrl = 'https://api.postmarkapp.com/email'

myUrl = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + str(gameId) + "?api_key=" + api_key

for i in range(0,10):

  buffer = BytesIO()
  c = pycurl.Curl()
  c.setopt(c.URL, myUrl)
  c.setopt(c.WRITEDATA, buffer)
  c.perform()
  c.close()

  body = buffer.getvalue()
# Body is a byte string.
# We have to know the encoding in order to print it to a text file
# such as standard output.
  print(body.decode('iso-8859-1'))

  gameId += 1




#data = json.dumps({"From": "user@example.com", "To": "receiver@example.com", "Subject": "Pycurl", "TextBody": "Some text"})
#
#c = pycurl.Curl()
#c.setopt(pycurl.URL, myUrl)
#c.setopt(pycurl.HTTPHEADER, ['X-Postmark-Server-Token: API_TOKEN_HERE','Accept: application/json'])
#c.setopt(pycurl.POST, 1)
##c.setopt(pycurl.POSTFIELDS, data)
#c.perform()
