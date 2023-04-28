#South Stream Gas Market App

This is an example app for South Stream gas import. The app allows users to register and log in to use it. Once logged in, users can insert new entries for gas import with the following data: import country (Russia, Ukraine, Bulgaria, Hungary, Romania or North Macedonia), amount of gas in Mmbtu, price in $ per Mmbtu and date of import. Users can also see a list of all entries with an option to delete an entry. Additionally, users have the option to select one or more countries and see imports just from them and also the average price for gas import for each country.

##Features

* User registration and login
* User authentication
* Inserting new entries for gas import with the following data:
  * Import country (Russia, Ukraine, Bulgaria, Hungary, Romania or North Macedonia)
  * Amount of gas in Mmbtu
  * Price in $ per Mmbtu
  * Date of import
* Viewing all entries with an option to delete an entry
* Filtering entries by country
* Viewing the average price for gas import for each country.
* The app is written in procedural PHP 

## Installation

To install the app, follow these steps:

Clone the repository from GitHub: 

```
git clone https://github.com/aleksandarTcode/gas_market
```

Install dependencies using Composer: 

```
composer install
```

Use the fresh_database/south_stream.sql file to set up the database.

All example users have the password 123456@Aa

## Usage

To use the app, open it in a web browser and register for an account. Once you have an account, log in and start inserting new entries for gas import. You can view all entries and delete them if necessary. You can also filter entries by country and view the average price for gas import for each country.
License

##Contributing

If you would like to contribute to this app, please open an issue or submit a pull request.