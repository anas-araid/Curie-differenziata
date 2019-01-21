# Curie Differenziata

Simple and fast rating system for waste recycling at Marie Curie Pergine School

## Getting Started

These instructions will get you a copy of the project to running on your local machine for development and testing.

### Prerequisites
```
* xampp
```

### Installing

#### Set up your server

* Copy this repo into your xampp htdocs folder

#### Set up the database
* Start the XAMPP control panel (xampp-control.exe)
* From the control panel, start Apache and MySQL
* Click "Admin" for MySQL or navigate to localhost/phpmyadmin in your browser
* Copy "Curie-differenziata/db/my_curie.sql" file into SQL tab


```
In your browser, navigate to localhost/Curie-differenziata and start testing...
```


## Contribution

### What is Curie-differenziata?

A rating system, that allow the school to check the recycle situation in classrooms and offices.

### Guidelines

Take a moment to read this document in order to make the process simple and consistent with the one used by the rest of the contributors.

* Fork the project
* Make a pull request

```
The final user is the school operator that will provide the checking and rating, so the interface must be easy and intuitive, like the [project prototype](../docs/img).
```


#### Some coding standards

* In style.css every class must start with _style-classname_
* Every php function file must be saved in core/ directory

#### Entities

* SchoolOperator (t_operatori)
 -ID
 -Name
 -Surname
 -Code
 -Password

* WasteType (t_tipologia)
 -ID
 -Type

* WasteBin (t_cestino)
 -ID
 -Photo
 -Rating
 -ID_WasteType

* Address
 -ID
 -Description

* Room
 -ID
 -Classrooms
 -ID_Address

* Checking
 -ID
 -Date
 -ID_SchoolOperator
 -ID_WasteBin
 -ID_Address

#### License
```
By contributing to the code or documentation, you agree to release your code according to the open source license already present in the project repository.
```

## Built With

* [XAMPP](https://www.apachefriends.org/it/index.html) - Web server
* [PHP](http://php.net/manual/it/intro-whatis.php) - Scripting language
* [MDL](https://getmdl.io/) - Material Design Lite
* [Atom](https://atom.io/) - Atom text editor

## Authors

* **Anas Araid** - [asdf1899](https://github.com/asdf1899)
