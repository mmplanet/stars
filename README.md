Stars Demo

How to run the app:

Configure the database connection and run the following commands in this order:

- `composer install`
- `bin/console doctrine:migrations:migrate`
- `bin/console doctrine:fixtures:load`
- `symfony serve`


API DOC (JSON):
http://localhost:8010/api/doc.json

for /api endpoints, the 
`Sky-authorization : main300` header is needed.
Unique stars api endpoint example:

`http://localhost:8010/api/sky/galaxy/6/stars?sortBy=size&elements=120,121&elementsNotInGalaxy=10&viewType=basic`
