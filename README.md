# Archi Test
API demonstration.

## Test Data
Place the ``back_end_test_data.xlsx`` file in the ``storage\app\xlsx`` directory. This will allow the file to be ingested to the database during seeding.

## Getting Started
Follow these steps to get the API up and running:
1. Clone this repository and run ``composer install``
2. Create a database and configure the connection in the project ``.env`` file
3. Run ``php artisan migrate``
4. Run ``php artisan db:seed`` 
5. Run ``php artisan storage:link``
5. Run ``php artisan route:cache``


## Usage
Endpoints are as follows:

### Properties
| Endpoint            | Method | Parameters             | Description
| ------------------- | ------ | ---------------------- | ----------------------------------
| property            | GET    | none                   | Get data for all properties
| property/{property} | GET    | none                   | Get data for specified property ID
| property            | POST   | suburb, state, country | Create new property
| property/{property} | PUT    | suburb, state, country | Update existing property
| property/{property} | DELETE | none                   | Delete existing property

### Property Analytics
| Endpoint                      | Method | Parameters   | Description
| ----------------------------- | ------ | ------------ | --------------------------
| property/{property}/analytics | GET    | none         | Get analytics for property
| property/{property}/analytics | POST   | type, value  | Add new analytic for property
| property/{property}/analytics | PUT    | type, value  | Update analytic for property

### Analytics
| Endpoint            | Method | Parameters             | Description
| ------------------- | ------ | ---------------------- | --------------------------------------
| analytics           | POST   | filter, search         | Get all analytics with optional filter

## Tests
Run ``php artisan test`` to test endpoint HTTP responses.

## Authors
* **Adam Crampton** - [Adam Crampton](https://github.com/adamcrampton)
