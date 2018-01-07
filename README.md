# BRACKE MANNEN - BETCOMP WK2018


## TODO:
- servercalls centraliseren (DONE)
- fb login
- wrong username/password message loginpage (DONE)
- poll om de matchen te kiezen waarop gegokt zal worden
- username/naam onwijzigbaar bij formulieren (DONE)
- username/naam standaard ingevuld bij formulieren (DONE maar hoeft eigenlijk niet, kan ook gwn ingevuld worden in de call) 
- profilepage waar profielfoto kan worden geupload (bij FORMS --> ADVANCED FORM ELEMENTS staat voorbeeld voor file upload)
- term of usage maken of check sign up verwijderen
- kijken naar padding want teveel ruimte (vooral op mobile) niet gebruikt
- verification van users (zie ook admin page)

##### Veiligheid:

- Accountgegevens in cookies?

##### Data ophalen:

- http://api.football-data.org/documentation
- momenteel voorbeeld van https://github.com/dfrt82/phplib-football-data in tabblad data_test geblaft.
  gebruikt in map pages: submap models, config.ini (te mergen met bestaande config? is met mijn API-key) en FootballData.php
  De competitielink voor WorldCup: http://api.football-data.org/v1/competitions/467
  
##### Admin Page:

- enkel toegankelijk voor beheerders
- mogelijkheid om velden in database te veranderen (vb. Mededelingen, bonussen als die niet geautomatiseerd raken...)
- verification van users handmatig zetten

##### Database:

- Structuur:

 brackemannen_be
 
    --> bc18_users
	
    --> bc18_klassement
	
    --> bc18_...
	
- Vlaggen:
   
   --> low-res: 23x15 pixels
   --> hi_res: 800x533 pixels

## EXTRA:

- chat?  
- map met stadiums + info