# BRACKE MANNEN - BETCOMP WK2018

##### UAT:


- [ ] calculate punten aanpassen zodat ook na poule werkt (met penalties)
- [ ] automatisch berekenen na de wedstrijd (nu nog manueel naar calculate.php gaan)
- [x] tijd van notificatie in UTC --> verzetten naar werkelijke tijdzone
- [x] timer next match geeft NAN wanneer hij op 0 was en niet automatisch naar nieuwe match
- [ ] navbar collapse
- [ ] eventueel ook kolom me aantal gegokte matchen bij klassement
- [x] chat?  
- [x] map met stadiums + info
- [x] mogelijkheid om bets te zetten nadat match gestart is (wrs opgelost wanneer matchen niet manueel toegevoegd worden)
- [x] berekening score werkt enkel als match op FINISHED staat (gebeurt automatisch als matchen niet manueel toegevoegd worden)
- [x] navigator
- [x] nice to have: overzicht van iedereen zijn bets van vorige matchen met juist of fout (zoals de excel van vorig jaar)
- [x] notificatie blijft 5 ongelezen berichten aangeven FIXED



## TODO:

- [x] poll om de matchen te kiezen waarop gegokt zal worden
- [ ] spelregels finaal maken
- [ ] veld op indienen aanpassen zodat laatste veld een dropdown is om de winnaar aan te duiden
- [x] term of usage maken of check sign up verwijderen  --> voorlopig verwijderd --> makkelijk toe te voegen indien nodig
- [ ] kijken naar padding want teveel ruimte (vooral op mobile) niet gebruikt
- [x] change username form aanpassen (enkel nieuwe username mag)
- [ ] rommel opkuisen van template (vooral map plugins is groot)
- [ ] vuilste ploeg bonus berekenen
- [ ] code voor achievements berekenen
- [x] contact page --> messages dubbel in db en op pagina
- [x] juiste ster tonen bij juiste aantal achievements

##### Veiligheid:

- [ ] Accountgegevens in cookies?
- [ ] geen rare tekens in register
- [ ] check session --> email ingevuld en in db? 

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





	
