# BRACKE MANNEN - BETCOMP WK2018


## TODO:
- servercalls centraliseren (DONE)
- fb login
- wrong username/password message loginpage (DONE)
- poll om de matchen te kiezen waarop gegokt zal worden
- Vlaggen ook in hogere res
- Alle vlaggen resizen tot zelfde formaat
- username/naam onwijzigbaar bij formulieren (DONE)
- username/naam standaard ingevuld bij formulieren (DONE maar hoeft eigenlijk niet, kan ook gwn ingevuld worden in de call) 
- profilepage waar profielfoto kan worden geupload (bij FORMS --> ADVANCED FORM ELEMENTS staat voorbeeld voor file upload)
- term of usage maken of check sign up verwijderen
- kijken naar padding want teveel ruimte (vooral op mobile) niet gebruikt
- change username form aanpassen (enkel nieuwe username mag)

##### Veiligheid:

- Accountgegevens in cookies?
- geen rare tekens in register
- check session --> email ingevuld en in db? 

##### Users:

- Verification

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

## EXTRA:

- chat?  
- map met stadiums + info