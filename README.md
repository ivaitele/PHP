#KCS WEB Kurso medžiaga
##Kaip pradėti naudotis?
* Instaliuokite Git ([instrukcija](https://git-scm.com/downloads))
* Instaliuokite PHP 7.4 ([instrukcija](https://www.youtube.com/watch?v=SR33B74gWL4))
* Instaliuokite Composer ([instrukcija](https://getcomposer.org/doc/00-intro.md))
* Instaliuokite Docker ([instrukcija](https://docs.docker.com/install/))
* Terminale rašykite: 
  * `composer --stability=dev create-project kaunas-coding-school/web`
  * `docker-compose up` 

### Projekto failų architektūra
```
project
|--- Docker (Dokerio komteinerių konfigūraciniai failai)
|--- public_html (Viešai prieinami failai matomi lankytojams)
|--- src (Aplikacijos išeities kodo failai)
|--- vendor (Bibliotekų failai)
```