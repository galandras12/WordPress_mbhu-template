=== Mezőberény Városi Sablon ===

Ez a WordPress téma a mezőberény.hu weboldalon látott elrendezést és
stílust követi: sötét felső elérhetőségi sáv, szépia városkép fejléc
díszes cirkalmas felirattal, három hasábos elrendezés (bal oldalt
"Elérhetőségek" és "Menü" doboz, jobb oldalt "Köszöntő", "Keresés",
"Eseménynaptár", "Anyakönyvi hírek" stb.), gyorslink gombsor és
kétoszlopos hírblokk krém-barna színvilágban.

FONTOS: a mezőberény.hu tényleges fényképei (a szépia városkép fejléc,
a polgármesteri fotó, a pályázati banner logók) nem részei ennek a
sablonnak - ezeket a saját WordPress admin felületeden kell feltöltened
(lásd lent), mert nem tudtuk automatikusan lekérni az élő oldalról.


-- 1. Telepítés --

1. Tömörítsd ZIP-be a "mezobereny" mappát (wp-content/themes/mezobereny),
   vagy töltsd fel a teljes mappát FTP-n/SFTP-n a wp-content/themes/
   könyvtárba.
2. WordPress admin » Megjelenés » Témák » aktiváld a "Mezőberény Városi
   Sablon" témát.


-- 2. Fejléckép (szépia városkép banner) --

Megjelenés » Testreszabás » Fejléckép (vagy Megjelenés » Fejléckép),
és töltsd fel a mezőberény.hu-hoz hasonló panorámaképet (ajánlott
méret kb. 1600×230 px, széles, alacsony banner). Amíg nincs feltöltve
kép, egy égszínkék színátmenetes helykitöltő jelenik meg.


-- 3. Logó / "Mezőberény" felirat --

Alapértelmezésben a honlap címe (Beállítások » Általános » Cím)
díszes, kézírásos betűtípussal (Great Vibes) jelenik meg, közvetlenül
a fejlécképre ráhelyezve (bal alul), alatta egy dekoratív kacskaringó
vonallal és egy kis címerpajzs-motívummal - pontosan úgy, mint az
eredeti oldalon. Ha inkább egy kész logóképet szeretnél használni,
töltsd fel a Megjelenés » Testreszabás » Site Identity » Egyedi logó
alatt - ekkor a képet fogja megjeleníteni a szöveges felirat helyett
(a kacskaringó és címer csak a szöveges logóváltozatnál jelenik meg).
A kis címerpajzs egy általános dekor-elem, nem a tényleges városi
címer - ha szeretnéd, cseréld le a header.php-ban (mb-logo-crest SVG)
a valódi címerre.


-- 4. Menük --

Megjelenés » Menük alatt hozz létre (vagy rendelj hozzá) 3 menüt:

  - "Bal oldali Menü doboz"  → a bal oldalsáv "Menü" dobozában jelenik
    meg (Kezdőlap, Hírek, Városunkról, Önkormányzat, stb.). Ha egy
    menüponthoz almenüpontokat adsz (behúzással a Menük szerkesztőben),
    azok az eredetihez hasonlóan kicsúszó ("flyout") panelként jelennek
    meg jobbra, amikor az egér a szülő menüpont fölé kerül. Egy adott
    menüpontot piros-fehér-zöld sávval kiemelhetsz a "menu-flag" CSS
    osztály hozzáadásával (mint a "Választási információk" az eredetin).
  - "Gyorslink gombsor (főoldal teteje)" → a főoldal tetején lévő
    barna gombsor (pl. "Helyi rendeletek", "Egészségügyi ellátás",
    "Testületi ülések meghívói", stb.). Ha egy menüpontot zöld színnel
    szeretnél kiemelni (mint a "Közvilágítás hibabejelentés" gomb az
    eredetin), add hozzá a "highlight" CSS osztályt a menüponthoz
    (Menüpont beállításai » CSS osztályok - ehhez engedélyezd a
    Képernyőbeállításokban a "CSS osztályok" mezőt).
  - "Lábléc linksor" → Impresszum, Oldaltérkép, GYIK, Akadálymentesítési
    nyilatkozat stb.


-- 5. Widgetek --

Megjelenés » Widgetek alatt 3 widget-terület áll rendelkezésre:

  - "Bal oldalsáv - Elérhetőségek": cím, telefonszám, e-mail cím,
    épületfotó (pl. Egyéni HTML vagy Kép + Szövegblokk widgettel).
  - "Bal oldalsáv - Banner képek": pályázati/partner logók, egymás
    alatt (Kép widget, többször egymás után).
  - "Jobb oldalsáv": ide kerül minden jobb oldali doboz, a hozzáadás
    sorrendjében egymás alatt jelennek meg:
      • "Mezőberény: Köszöntő" (egyedi widget - fotó + üdvözlő szöveg)
      • Keresés (WordPress alap widget)
      • Naptár (WordPress alap widget) - akár kétszer egymás után
      • Kép / Galéria widget az "Események képekben" dobozhoz
      • Egyéni HTML/Szövegblokk a Hírmondó letöltés-linkekhez
      • "Mezőberény: Anyakönyvi hírek" (egyedi widget - Megházasodtak/
        Elhunytak fül-váltós lista)
      • Kép widget a "Hősi Halottaink", "Madárbarát Település", "HURO"
        bannerekhez

A két egyedi widget ("Köszöntő" és "Anyakönyvi hírek") a téma saját
widgetjei - a widget hozzáadásakor a listában "Mezőberény: ..." néven
találod őket.


-- 6. Tartalom --

A főoldal (front-page.php) a legutóbbi bejegyzéseket két oszlopba
rendezve jeleníti meg ("Kiemelt hírek" / "Kiemelt cikkek" - felváltva).
Hozz létre bejegyzéseket (Bejegyzések » Új hozzáadása) a hírekhez, és
oldalakat (Oldalak » Új hozzáadása) az olyan tartalmakhoz, mint
"Elérhetőségek", "Városunkról", stb. Ha statikus kezdőlapot állítasz
be (Beállítások » Olvasás), győződj meg róla, hogy a kezdőlap sablonja
"Front Page" (ezt WordPress automatikusan a front-page.php-ra képezi).


-- 7. Dátum + névnap sor --

A fejléc jobb oldalán megjelenő "Ma {dátum}, {névnap} napja van" sor
automatikusan generálódik (inc/namedays.php). A benne szereplő
névnaptár a legjobb tudásunk szerint készült - érdemes telepítés után
átnézni/pontosítani, mivel több magyar naptárkiadás kis mértékben
eltér egymástól.


-- 8. Mobil nézet --

Az eredeti mezőberény.hu-nak nincs gyári mobil nézete - ez a sablon
kap egy sajátot, ami a megszokott kinézetet (aranyszín-krém dobozok,
betűtípusok, gombok) tartja meg kisebb képernyőn is:

  - ≤900px szélesség alatt megjelenik egy hamburger-gomb a fejléc
    alatt, ami lenyitja a "Menü" navigációt (ugyanaz a menü, mint a
    bal oldalsáv Menü doboza - ezért az a doboz mobilon el van rejtve,
    hogy ne szerepeljen duplán).
  - A hasábok sorrendje mobilon: előbb a fő tartalom, utána az
    Elérhetőségek/Menü doboz, végül a jobb oldalsáv - így a
    látogatónak nem kell hosszan görgetnie a hírekig.
  - A fejléckép és a cirkalmas logófelirat kisebb képernyőn arányosan
    zsugorodik (900px / 600px / 400px töréspontok).
  - A gyorslink gombsor 2, majd 1 oszlopossá válik keskeny
    képernyőkön; a lábléc és a felső kisegítő sáv középre igazítva,
    tördelve jelenik meg.


-- 9. Betűméret / kontraszt kapcsoló --

A felső sávban lévő "A A A" gombok és a kontraszt-ikon valós funkciót
látnak el (assets/js/accessibility.js): a betűméretet és egy egyszerű
sötét kontrasztos nézetet kapcsolnak, a választást a böngésző menti
(localStorage), így visszatéréskor is megmarad.


-- 10. Színek / stílus finomhangolása --

Minden szín CSS-változóként van definiálva a style.css tetején
(:root { --mb-cream: ...; --mb-gold-dark: ...; stb. }) - ha az élő
mezőberény.hu oldal színei pontosabban eltérnének, itt egy helyen
állíthatók át.
