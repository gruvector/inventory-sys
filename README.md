# README #


## What is this repository for? ##

This repository is for an  open source web based  inventory system.   
This inventory system can be used for entities/institutions which have multiple sites but need a centralized system for monitoring inventory across all sites.   
It can be used for
 
* performing sales,receivables,invoicing and also reversal(cancellation) of transactions for the various inventory items
* Staff management functions(creation,deletion,role assignments) can be done for sites,users
* Support for bar codes isn't yet supported but will be built in soon
* manual for application is being done .will be uploaded soon
  



## Summary of set up ##
  the inventory_sys is a web based application so typically a web server and database management system is needed .  
 Web server can be apache,iis or any which supports php 5.5.9 or above and also supports mysql .

## Dependencies ##
*  php 5.5.9 or above
*   nodejs v0.10.25 or above . this is used for the print server which will print the    receipts
*   cakephp 2.6.9 or above.  

## Configuration ##
  inventory system  uses a mysql database .  
  Create a database called ```inventory_sys``` on your host machine .  
  Run the ```inventory_sys_def_install.sql``` a mysql script in the ```/dbase/ ``` folder  to populate the database after it has been created.  
Go to ```inventory_sys/Config/app/config/database.php```
  change the value of host,login,password,database to those of your database in the section below.
  
  ```
  public $default = array(  
		'datasource' => 'Database/Mysql',   
		'persistent' => false,   
		'host' => 'host_ip/host_name',  
		'login' => 'username_database',  
		'password' => 'password_database',  
		'database' => 'database_name',  
		'prefix' => '',
		//'encoding' => 'utf8',  
	);
  ```

##Printer Settings##
  application has to be configured to know printer it is using for printing .   
  This can be configured in ```inventory_sys/app/webroot/js/socket.io/printServer.js``` by changing the ```var printer_lpr_options=""``` to point to the correct printing device .   
  So if the receipt printer device is ```LPT1``` the variable becomes ```var printer_lpr_options="LPT1"```


## Deployment instructions ## 
   copy the inventory_sys folder to to your web root folder of your web server installation.
   
   Browse to ```http://host_ip|host_name/inventory_sys/```.
   
 Login in with default credentials: 

*  _username_:inv@inv.com   
* _password_:123
   
Please reset password after you login.   
 Later password requirements will be added to  password logins but not currently in system.   
  If u get issues with url rewriting or problems with paths go to 
[Cakephp](https://book.cakephp.org/2.0/en/installation/url-rewriting.html) or wire me an email . 
  

### Who do I talk to? ###

* nayibor@gmail.com


# CakePHP

[![Latest Stable Version](https://poser.pugx.org/cakephp/cakephp/v/stable.svg)](https://packagist.org/packages/cakephp/cakephp)
[![License](https://poser.pugx.org/cakephp/cakephp/license.svg)](https://packagist.org/packages/cakephp/cakephp)
[![Bake Status](https://secure.travis-ci.org/cakephp/cakephp.png?branch=master)](http://travis-ci.org/cakephp/cakephp)
[![Code consistency](http://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/grade.svg)](http://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/)

[![CakePHP](http://cakephp.org/img/cake-logo.png)](http://www.cakephp.org)

CakePHP is a rapid development framework for PHP which uses commonly known design patterns like Active Record, Association Data Mapping, Front Controller and MVC.
Our primary goal is to provide a structured framework that enables PHP users at all levels to rapidly develop robust web applications, without any loss to flexibility.
