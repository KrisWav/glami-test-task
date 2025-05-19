# php-test-task

### Cíl 

**Cílem je provést Code Review** třídě [src/Event.php](src/Event.php),
která má metody pro vložení nové události, vypsání celkového počtu událostí a
výpis počtu událostí pro jednotlivé typy.

Kód by měl splňovat PSR-12 coding standard a běžné vlastnosti PHP 8.0. 
Být bez logických, bezpečnostích a performance chyb.

### Data v databázi

Jedná se o seznam událostí, které se odehrály mezi M a N.

Každá událost má čas (`created`) vytvoření a typ (`type`).

#### SQL Tabulka

```sql
CREATE TABLE `Event`
(
    `eventId` INTEGER PRIMARY KEY ASC,
    `type`    VARCHAR(255) NOT NULL,
    `created` TIMESTAMP    NOT NULL
);
CREATE INDEX created ON Event (created);
```


#### Příklad dat

| eventId | type     | created             |
|---------|----------|---------------------|
| 1       | click    | 2022-11-24 00:00:00 |
| 2       | purchase | 2022-11-24 00:00:01 |
| 3       | purchase | 2022-11-24 00:00:02 |
| 4       | skip     | 2022-11-24 00:00:03 |
| ....    | ...      | ...                 |
| 999999  | click    | 2022-11-25 03:46:47 |
| 1000000 | click    | 2022-11-25 03:46:48 |

### Start

Není nutné cokoliv spouštět. Je to jen ukázka funkčnosti třídy [src/Event.php](src/Event.php). 

Cílem je provést Code Review. 

```cli
composer install
php utils/dataGenerator
```

```cli
php utils/dataGenerator.php
```

```cli
php show.php
```

### Poznámky

Data jsou uložená v SQLite, aby bylo možné spustit kód téměř na "holém" PHP. 
Jinak v GLAMI používáme MySQL.

