#KCS WEB Kurso medžiaga
##Kaip pradėti naudotis?
* Instaliuokite Composer ([instrukcija](https://getcomposer.org/doc/00-intro.md))
* Instaliuokite Docker ([instrukcija](https://docs.docker.com/install/))
* Terminale rašykite: 
  * `composer create-project kcs/web .`
  * `docker-compose exec web composer`
  * `docker-compose up` 

### Projekto failų architektūra
```
project
|--- Docker (Dokerio komteinerių konfigūraciniai failai)
|--- public_html (Viešai prieinami failai matomi lankytojams)
|--- src (Aplikacijos išeities kodo failai)
|--- vendor (Bibliotekų failai)
```