## REST API 
Celem aplikacji jest umożliwienie przesłania przez użytkownika informacji odnośnie firmy oraz jej pracowników

Wszystkie endpointy wraz z przykładowymi requestami zostały zapisane w katalogu *requests*

Aby uruchomić aplikacje należy:
1. Sklonować repozytorium projektu
```shell
git clone git@github.com:klentak/businessApi.git && cd businessApi
```
2. Stworzyć plik .env na bazie .env.local i podmienić w nim nazwę użytkownika "{dbUsername}" oraz hasło "{dbPassword}" do wcześniej wystawionej lokalnie bazy potgresql
3. Zainstalować zależności Composer
```shell
composer install
```
4. Przeprowadzić migrację bazy danych
```shell
php bin/console make:migration
```
5. Uruchomić lokalny serwer dostarczony przez symfony
```shell
symfony server:start
```
