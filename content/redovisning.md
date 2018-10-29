---
---
Redovisning
=========================




Kmom01
-------------------------

**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**

Det kändes väldigt bra som en början.
Jag kan även relatera till andra språk som vi har använt i tidigare kurser som python, men även C# som vi dock inte har haft i någon kurs.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**

Det blev en rolig uppgift att genomföra.
Vi fick lära oss hur vi kan återanvända en klass för ett flertal klienter, på så sätt slipper man skapa flera klasser med repeterande logik för att klara av GET eller SESSION med POST.
Rätt viktigt att vi lär oss detta från början tycker jag.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**

Jag förväntade mig en del svårigheter med att redigera de olika delarna och stilen.
Efter att ha kollat igenom hur liggande filer var strukturerade så blev det rätt klart hur man ska använda Anax på denna nivån.
Tycker att det blev rätt lätt att både lägga till style & js, men även att ha en dynamisk meny som man kan ändra.


**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom har varit användandet av klasser i PHP och att designa en klass att bli återanvändbar mellan ett flertal klienter.
Med me-sidan så fick jag inblick i hur Anax fungerar, iallafall en liten del.
Det ser lovande ut och jag ser fram emot att få arbeta mer i Anax och se vad det egentligen går för.
Fick även fräscha om minnet om verktyget "make", det var ett tag sedan vi fick arbeta med det, nu känns det lika klart som förr.
Det blev lite problem med min PHP version bara, hade 7.1 på min XAMPP men jag lyckades uppgradera version utan att behöva ominstallera hela XAMPP.



Kmom02
-------------------------

**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**

Efter att ha kollat på videoserien så började det klarna för mig hur jag ska gå till väga.
Blev lite felmeddelanden trots allt men det var för att jag glömde inkludera en variabel i $data arrayn inom route filen, så vyn som behövde tillgång till den variabeln klagade på att den inte är definerad.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**

Jämför man med UML och phpDocumentor så tycker jag inte att det är en rättvis jämförelse.
Med UML ser man klart och tydligt vad en klass innehåller för attribut och metoder.
PhpDocumentor är mer till att förklara vad dessa attribut och metoder där, där man då skriver docblock kommentarer och beskriver funktionaliteten i dem.
Fördelar med UML? Att lätt se klassernas struktur och relation.
Fördelar med phpDocumentor? Att lätt se vad en klass har för innehåll och beskrivning av dess delar via ett webbaserat gränssnitt, man slipper gå igenom koden och lusläsa sig fram till det man egentligen ville först åt.
Nackdelar med UML och phpDocumentor? Har inte använt dessa 2 verktyg tillräckligt mycket för att se någon nackdel.
Jag gillar make doc för att snabbt generera en dokumentation, väldigt smidigt att den läser docblock kommentarer och genererar en vy utifrån det.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**

Det kändes lite ovanligt i början att konvertera koden till att funka inuti ramverket.
Men efter denna uppgift så tycker jag att jag förstår mig mer på hur det funkar.
Återigen, nackdelar? Inte jobbat tillräckligt mycket för att hitta några.


**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom har varit att konvertera kod till att fungera inuti ramverket, har fått mer förståelse för autoloadern och vyer samt routes.



Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**

Jag har rätt så lite erfarenhet av att skriva kod som testar annan kod, har gjort det tidigare i både C# och Python.
Då körde jag unit tester och kollar jag på unit tester i PHP så är principen ändå samma, strukturen skiljer sig bara.

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**

Det är ett bra sätt att testa koden ju större den blir, speciellt om man jobbar i ett team.
Man behöver då skriva enhetstester för att försäkra sig att funktionerna gör som dem ska, om man själv ska jobba på ett projekt så kanske det inte är så nödvändigt men det är alltid en sorts försäkring tycker jag.
Ibland så känns enhetstester så tråkigt och onödigt, men det spar en del huvudvärk senare när man försöker pilla på något i koden som krockar med något test, då vet man precis vart man ska kolla.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**

White-box testing uppfatta jag som när man testar koden inuti källkoden/applikationen, och då måste man givetvis ha tillgång till källkoden för att köra enhetstesterna.
Black-box testing är att man utför testerna från utsidan, d.v.s personen som använder applikationen utför testerna och inte som i White-box testerna att koden utför testerna.
Grey-box testing är en mix av både white-box och black-box, kombinerat så används effektivt för att hitta buggar och defekter inom applikationen.
Positiva tester är när enhetstesterna körs som man har tänkt sig och negativa tester körs när man inte förväntar sig att det ska funka typ med Exceptions osv.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**

Jag började med att rita uml (som jag ändå var tvungen att göra om tillslut) för att få en överblick i hur koden kan komma att se ut.
Jag använde /Dice klasserna som bas, tänkte mig att det ska endast vara 2 spelare som kan spela (Användaren och Datorn).
Spelet utför olika handlingar beroende på vilken POST data som skickas med i formuläret varje gång man klickar på en knapp.
Efter att ha testat spelet själv och skrivit enhetstester så började jag rensa upp koden lite och sätta "private" visibility på variablar jag inte vill kunna ändra utanför klassen Game.

**Hur väl lyckades du testa tärningsspelet 100?**

Jag lyckades bra tycker jag.
Vad gäller enhetstesterna jag skrev så fick jag inte så mycket kodtäckning som jag hade hoppats få men p.g.a tidsbrist så får jag låta det vara tillsvidare.

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom var mer användningen av ramverket session service och mer enhetstester, samt en massa type errors som vanligt :)



Kmom04
-------------------------

**Vilka är dina tankar och funderingar kring trait och interface?**

Interface är superviktigt när det kommer till klasser och olika typer av inheritence.
Det avgör hur funktioner bör se ut, och vilka typer av argument som borde matas in i en specifik funktion.
Trait tycker jag är ett enkelt sätt att utöka funktionaliteten hos en klass utan behovet av att skapa en ny klass eller kladda ner klassen, man kan även återanvända Trait's utan att behöva extenda någon klass.

**Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du?**

Det gick rätt smidigt, tog lite tid innan jag förstod hur man skulle använda Histogrammet.
Vad gäller intelligensen så gjorde jag att om datorn har över 70 poäng så finns det en 50% chans att den kommer att fortsätta eller 50% att den ger över rundan till spelaren istället, den tar egna beslut då. 

**Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur?**

Tycker att README filerna var väldigt hjälpsamma och rak på sak.
Trevligt att använda SESSION utifrån $app istället för att skapa ett nytt SESSION objekt.
GET och POST data har man lätt tillgång till via $app->request vilket underlättar mycket och gör koden snyggare och mer konsistent tycker jag.

**Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick.**

Lyckades väl helt okej, hade mer än gärna skrivit fler tester men har inte mycket tid för det.
Vad gäller kodtäckning så fick jag mellan medium och high, såg till att alla objekt instanser matchar det som förväntas, i Dice testen såg jag till att testa både roll() och sides.

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom har varit hur man använder Traits och Interfaces.
Vi har även Histogrammet som tog mig ett tag att förstå men jag börjar komma in i det, jag lärde mig även flera "assert" funktioner i PHPUNIT.



Kmom05
-------------------------

**Några reflektioner kring koden i övningen för PHP PDO och MySQL?**

Det var spännande att hoppa in i PHP PDO och faktiskt använda det, övningen hanterade routes och olika databasförfrågningar tillsammans med vyer på ett enkelt sätt som inte är svårt att förstå.
Gillade trixet med att man kan köra gitignore på sin personliga databas konfiguration och istället ha en "database_sample" config.

**Hur gick det att överföra koden in i ramverket, stötte du på några utmaningar?**

Jag upplevde inga större problem, jag följde alla steg i instruktionerna och det fungerade galant.
Efter att koden var överförd till ramverket så började jag ersätta alla "getGet()" och "getPost()" med "$app->request->getXxx()" för att använda mig av ramverkets Request objekt.
Jag valde att istället köra all logik inom en route och inte dela upp routes och olika GET-POST metoder p.g.a tidsbrist, en ful lösning men den funkar..

**Berätta om din slutprodukt för filmdatabasen, gjorde du endast basfunktionaliteten eller lade du till extra features och hur tänkte du till kring användarvänligheten och din kodstruktur?**

Då jag återanvände nästan all kod från övningen "PHP PDO och MYSQL" så fick jag implementera de extra features som fanns, vad gäller användarvänligheten så gjorde jag minimalt med styling vad gäller tabellerna, det blev ändå inte allt för kladdigt utan tvärtom, rätt enkelt.

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom har varit att koppla ihop databasen med studentservern och att använda mig utav olika databas konfigurationer beroende på vart scriptet körs (lokalt eller studentservern).
Fick även lära mig fler Anax funktioner som kommer vara till nytta längre fram.



Kmom06
-------------------------

**Hur gick det att jobba med klassen för filtrering och formatting av texten?**

Väldigt bra faktiskt. Uppskattade att koden redan fanns klar för de olika filters vi hade istället för att vi själva skulle implementera vår egen bbcode markdown konvertering.
Jag gjorde även att alla länkar blir klickbara som standard tillsammans med nl2br.

**Berätta om din klasstruktur och kodstruktur för din lösning av webbsidor med innehåll i databasen.**

Jag skapade 3 klasser, Content, Blog och Page.
Content är huvudklassen som Blog och Page ärver från.
Content implementerar interfacet AppInjectableInterface för att man ska kunna använda $app och med hjälp av AppInjectableTrait så är setApp() metoden tillgänglig där.
Klassen innehåller också ett flertal metoder för att hämta, lägga till, uppdatera och ta bort data från Content tabellen.
Blog och Page ärver som sagt Content och i konstruktorn så skickar jag även med in ett värde som indikerar vilken typ av innehåll det är, antingen post eller page då i detta fallet.

**Hur känner du rent allmänt för den koden du skrivit i din me/redovisa, vad är bra och mindre bra? Ser du potential till refactoring av din kod och/eller behov av stöd från ramverket?**

Ramverket har verkligen hjälpt till att organisera koden och samtidigt förbereda inför databas uppgiften.
Jag kunde personligen ha spenderat mer tid på att organisera mina routers och skriva fler enhetstester men eftersom tiden är snart slut så får det bli till nästa gång i nästa kurs.

**Vilken är din TIL för detta kmom?**

Min TIL för detta kmom har varit användandet av AppInjectableInterface och AppInjectableTrait från Anax ramverket.
Har även lärt mig organisera SQL koden och olika typer av inlägg i klasserna Content, Blog och Page.
Jag valde att även implementera databas återställnings funktionen och då fick jag först hämta databas konfigurations parameterar via $app->get("configuration")->load("database") vilket jag aldrig har gjort innan.



Kmom07-10
-------------------------

Här är redovisningstexten
