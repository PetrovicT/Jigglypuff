# Instrukcije za kodiranje
Par instrukcija za kodiranje, bilo bi super da ih se držimo, biće nam lakše da spajamo sve što radimo.
Ako imate neke primedbe, nešto hoćete da promenimo, slobodno recite!
## Pre nego što počnemo
1. Treba restrukturirati repozitorijum. Oko toga bi bilo najbolje da se dogovorimo na sastanku.  
2. Treba linkovati folder na našim lokalnim repozitorijumima sa folderima naših WAMP servera komandom `mklink`. To možemo isto na sastanku.
3. Treba da premestimo html prototipe na folder za implementaciju i da ih prebacimo u PHP. To isto možemo na sastanku, a mogu i ja pre njega  
  3.1. Treba da rasparčamo neke komponente, tj. da ih izvadimo iz prototip stranica. Header i footer sigurno. Njih ćemo posle da insertujemo pomoću PHP-a. Da ne moramo da kopiramo posle te stvari kadgod napravimo neku izmenu.
4. Vera, ti treba da proveriš šta ti je dostupno u RC-u, mada čini mi se po Tašinoj priči da je sve što ti treba.
5. Bilo bi super da watchujete repozitorijum, ili da skinete app na mobilni, da vam stignu notifikacije, ili mail, kad neko nešto bitnije uradi. (Neće za svaki commit, ne brinite)
6. Možemo startovati i novi kanban, taman da je popunimo na sastanku.
## Kodiranje i komentarisanje
Znam da smaram, ako vam se nešto ne sviđa, recite molim vas.
- OK, lepo kodiramo, pazimo da nam sve bude lepo uvučeno mooolim vas, ne ko prototipi.
	- Valjalo bi da se dogovorimo na sastanku oko nekih konvencija, spaces vs tabs i sl.
- Sve, apsolutno sve, nazivamo smislenim imenima, nebitno koliko su dugačka, samo da bude svima jasno o čemu se radi. Molim vas bez `var a`.
- Ne bojte se da izdvajate stvari u funkcije što više. Recimo, ako negde već postoji deo koda u nekoj funkciji koji bi mogao da bude zasebna funkcija (da bi se recimo pozvala više puta), izdvojte, nemojte da vas mrzi, lepše je in the long run.
- Redovno proveravajte podatke, da li su null, da li su u opsegu koji očekujemo, dobrog formata i slično. Desiće se da nešto propustimo sigurno.
- Greške bacajte uz menje-više opširnu poruku, da, ako nam negde iskoči, odmah znamo gde je greška i u čemu je problem, da je ne jurimo po kodu.
- Komentarišite što više, pomoći će i vama, verujte mi. Recimo neke bitnije stvari koje ja volim, al nije obavezno:
	- (OK, ovo je obavezno) Iznad funkcije napišite u par reči čemu služi, kakve podatke očekuje, šta vraća i šta vraća u slučaju greške, ako nije baš očigledno.
	- Ako je neki deo koda unutar funkcije malo komplikovaniji, slobodno iskomentarišite šta radi, da ne gledamo mi ostali 5 minuta šta to zapravo radi. A i olakša code review.
	- Ako je funkcija velika i podeljena u više "etapa", ne bi bilo loše da označite gde počinje svaka nova etapa, čisto radi lakšeg pregledanja.
## Pull request-ovi i review-ovi
Ovo je deo zbog kog sam najviše i hteo da napišem ovo. Zvuči kao smaranje, ali valja, verujte mi!  
  
Prvo, procedura za sve izmene. znači za baš baš svaku izmenu, osim onih naaaajsitnijih. Polećemo:  
  
0. Ništa nikad ne commitovati na master ako ima veze sa kodom. Ovo pogotovu važi ako neko ima neki izvučen branch.
Sad sam recimo komitovao par stvari jer niko ništa ne radi, pa neću nikom smetati, ali to će jako retko (nikad) biti slučaj.
Ono što je OK commitovati su stvari koje ne utiču na kod, kao recimo .doc fajlovi ili neki upload slika. Znaćemo uglavnom šta može da zasmeta.
1. Krećemo! Kad smo uzeli neki task da radimo, izdvajamo novi branch iz aktuelnog mastera. Nazivamo ga po tome šta radimo (Recimo: `RegistrationAndLoggingIn`). Ne koristimo neki stari branch!
2. Pišemo izmene... Kad smo završili, pravimo novi pull request iz naše grane u master. NE MERGUJEMO ODMAH!
3. Dodamo druga dva člana kao reviewere u PR. (Negde sa desne strane ima reviewers, čini mi se...)
4. E, sad, čekamo trpimo sve primedbe. Verovatno najviše od mene. U vidu komentara na strani PR-a. Kad napravimo izmene, samo ih commitujemo na branch i pushujemo. Pošto pull request "posmatra" branch1->branch2, nema potrebe da išta tu diramo, sam će se updateovati kad se updateuje i branch1.
5. Kad smo popravili sve što nije valjalo u kodu, čekamo approval od onog ko je napravio komentar. (Stići će jako brzo, jer watchujemo repo) A možda bude još primedbi.
6. E sad tek mergujemo.
7. Brišemo branch, ali nije obavezno. Git će sam ponuditi da ga obrišemo. Brišemo ga samo da ih ne bi bilo previše nepotrebnih. Ionako ako nešto novo počnemo da radimo, izdvojićemo novi branch iz mastera.

E tako, mislim da smo sve pokrili. Još neki saveti:
- Ne bojte se da cepidlačite nekom na review-u. Verovatno treba minut da se ispravi nešto što ne valja, a može da znači.
- Dok čekate na review, uzmite novi branch da radite nešto drugo, da ne gubite vreme.
- Ne paničite da ćete nešto da pokvarite, jako se lako revertuju ili resetuju branchevi. Mogu vam i to ispričati na nekom sastanku.



