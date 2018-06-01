# BRACKE MANNEN - BETCOMP WK2018

##### UAT:

- [x] mogelijkheid om bets te zetten nadat match gestart is (wrs opgelost wanneer matchen niet manueel toegevoegd worden)
- [x] berekening score werkt enkel als match op FINISHED staat (gebeurt automatisch als matchen niet manueel toegevoegd worden)
- [] calculate punten aanpassen zodat ook na poule werkt (met penalties)
- [] automatisch berekenen na de wedstrijd (nu nog manueel naar calculate.php gaan)
- [] tijd van notificatie in UTC --> verzetten naar werkelijke tijdzone
- [] timer next match geeft NAN wanneer hij op 0 was en niet automatisch naar nieuwe match
- [x] navigator
- [] navbar 
- [x] nice to have: overzicht van iedereen zijn bets van vorige matchen met juist of fout (zoals de excel van vorig jaar)
- [x] notificatie blijft 5 ongelezen berichten aangeven FIXED
- [] eventueel ook kolom me aantal gegokte matchen bij klassement
- [x] chat?  
- [x] map met stadiums + info



## TODO:

- [x] poll om de matchen te kiezen waarop gegokt zal worden
- [] term of usage maken of check sign up verwijderen
- []kijken naar padding want teveel ruimte (vooral op mobile) niet gebruikt
- [] change username form aanpassen (enkel nieuwe username mag)
- [] rommel opkuisen van template (vooral map plugins is groot)

##### Veiligheid:

- [] Accountgegevens in cookies?
- [] geen rare tekens in register
- [] check session --> email ingevuld en in db? 

##### Users:

- [x] Verification

##### Data ophalen:

- http://api.football-data.org/documentation
- momenteel voorbeeld van https://github.com/dfrt82/phplib-football-data in tabblad data_test geblaft.
  gebruikt in map pages: submap models, config.ini (te mergen met bestaande config? is met mijn API-key) en FootballData.php
  De competitielink voor WorldCup: http://api.football-data.org/v1/competitions/467
  
##### Admin Page:

- [x] enkel toegankelijk voor beheerders
- [x] mogelijkheid om velden in database te veranderen (vb. Mededelingen, bonussen als die niet geautomatiseerd raken...)

##### Database:

- Structuur:

 brackemannen_be
 
    --> bc18_users
	
    --> bc18_klassement
	
    --> bc18_...





	
