Introduction
============

Dinamička Web aplikacija za praćenje rada na donešenim uređajima na popravak. Korištenje za tvrtku Eurotrade d.o.o.
© Darko Pranjić

Za frontend dio je korišten  free template **AdminLTE**, kojeg sam doradio i izmijenio za moje potrebe (CSS i Javascript izmjene)

Frontend
============

Za frontend je korišten Javascript, Jquery i Ajax koji je dohvaćao JSON podatke. 

Backend
============

Za backend je korišten PHP koji se nalazi u folderu "klase". Za svaki dio u aplikaciji je napravljena klasa, koja pripada određenom dijelu programa (Primka, radni nalozi, osoba, djelatnik itd...). Koriste se 2. baze, MySQL i PostgreSQL. PHP vraća dohvaćene podatke u JSON formatu. Sve izmjene i dohvaćanja se odvijaju preko "json" foldera.

