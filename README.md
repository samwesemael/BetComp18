# BRACKE MANNEN - BETCOMP WK2018


## TODO:

- poll om de matchen te kiezen waarop gegokt zal worden
- term of usage maken of check sign up verwijderen
- kijken naar padding want teveel ruimte (vooral op mobile) niet gebruikt
- change username form aanpassen (enkel nieuwe username mag)
- rommel opkuisen van template (vooral map plugins is groot)

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

##### Database:

- Structuur:

 brackemannen_be
 
    --> bc18_users
	
    --> bc18_klassement
	
    --> bc18_...
	
	

## EXTRA:

- chat?  
- map met stadiums + info

## bespreken Sam na examens

-	bc18_klassement herbekijken
	nu winnaar en correcte score maar in laatste rondes dubbele score? Dus dan aparte kolom hiervoor???
	eventueel ook kolom me aantal gegokte matchen
	
-	API matchen veld met indicatie dat match gedaan is? --> vanaf wnr de uitslag meegerekend kan worden in berekening want nu probleem bij 0-0