# Projekt Knödel

## Aufbau und Funktionen

Welcome-Seite: Hier finden sich Links zu den Rezepten und den bestbewerteste Rezepten

Rezepte-Seite: Hier finden sich alle eingetragenen Rezepte

Rezepte-Neu-Seite: Hier kann man neue Rezepte einfügen

Rezepte-Bearbeiten-Seite: Hier kann man vorhandene Rezepte editieren

Kontakt-Seite: Hier kann man eine Nachricht an den Web-Site-Besitzer hinterlassen

## Verwendete Technik

* HTML  
* CSS  
* Vanilla JS - Ajax
* JQuery  
* Bootstrap  
* Laravel - als PHP Framework inkl. Eloquent    
* npm  
* Composer  
* Apache  
* MySQL    
* PHP

## Struktur des Source Codes

### app -> http -> controllers:  
ContactController => für das Kontaktformular
RecipeController => für die Rezepte
**Interessante Funktionen:**  
top() - gibt die 3 Rezepte mit der Besten Bewertung zurück  
store() - fügt Rezepte hinzu inkl. verschiedener Abfragen  
edit() - führt zur Bearbeitungsseite des Rezepts  
show() - Zeigt ganzes Rezept auf neuer Seite  
update() - Rezept wird mit neu editierten Werten versehen

### app -> http:  
Ingredient.php => Zutaten Model  
Recipe.php => Rezept Model  
RecipeIngredient => RezeptZuZutat Model  

### database -> factories:
Zutaten, Rezept Factories  
Factories erstellen passende Fake-Daten (zum Testing) zu unseren Models (Rezept, Zutat)

### database -> migrations:  
Definition und Anlage der MySQL-Tables  

### database -> seeds:
Rezept, Zutaten, DB Seeder - befüllt die DB mit vordefinierten Rezepten  
Zutaten: Jede Zutat, die geseedet werden soll, wird hier mit eindeutigem Namen angegeben  
Rezept: jedes Rezept, das geseedet werden soll, wird hier einzeln angelegt - inkl. den dazugehörigen Zutaten - diese müssen im Zutaten-Seeder vorhanden sein

### public -> img:  
JPGs für Rezepte & andere Ressourcen

### resources -> assets -> sass:  
CSS für Knödel-Seite
  
### views -> layout:  
Grund-Layout für alle Seiten (Unterschiedliche Layouts für unterschiedliche Seiten)  
 
### views -> layout -> partials:  
Layout für Header, Footer, Navigationsbar,...  
**Navbar** = Links zu den anderen Seiten

### views:  
**kontakt.blade.php** = Kontaktformular inkl. Check ob in die zwingenden Felder etwas eingegeben wurde  

**rezept.blade.php** = Rezept wird mit all seinen Feldern angezeigt  

**rezept_bearbeiten.blade.php** = holt sich die Attribute aus der DB und fügt diese in die Eingabe-Maske für Rezepte ein - diese können bearbeitet werden und werden in der DB upgedatet  

**rezept_erstellen.blade.php** = Maske für Eingabe des Rezepts, den Zutaten und des Bildes;  

**rezepte.blade.php** = zeigt in 3 Spalten alle vorhandenen Rezepte. View-Button führt zur Rezeptansicht; edit führt zur Edit-Ansicht;  
Bewertung des Rezepts wird angegeben  

**rezepte_top.blade.php** = zeigt die Top Rezepte an; wieviele Top es sind wird im passenden Controller gesteuert;  

**welcome.blade.php** = Startseite mit 2 Links 
  
### routes:  
**web.php** = hier werden die Routen gesetzt für get/post Aufrufe. 

### .env Datei == Konfigurationsdatei
  
