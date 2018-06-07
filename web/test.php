<?php

require_once ('../vendor/autoload.php');
require_once ('../src/Client.php');
require_once ('../src/Config.php');

$client = new Kreds\WebWalletApiClient\Client();

print "<br/><br>********************************** Status *********************************************<br/><br/>";
var_dump ($client->getStatus());

print "<br/><br>************************************ Info ***********************************************<br/><br/>";
var_dump ($client->getInfo());

print "<br/><br>************************************ Info ***********************************************<br/><br/>";
var_dump ($client->getSummary());

print "<br/><br>********************************* Addresses *********************************************<br/><br/>";
var_dump ($client->getAddresses());

print "<br/><br>********************************** Balance **********************************************<br/><br/>";
var_dump ($client->getBalance());

print "<br/><br>********************************** Deposits *********************************************<br/><br/>";
var_dump ($client->getDeposits());

print "<br/><br>******************************** Transactions *******************************************<br/><br/>";
var_dump ($client->getTransactions());

print "<br/><br>********************************** Withdraws ********************************************<br/><br/>";
var_dump ($client->getWithdraws());

print "<br/><br>********************************* NewAddress ********************************************<br/><br/>";
var_dump ($client->newAddress());

print "<br/><br>******************************** CreateAccount ********************************************<br/><br/>";
var_dump ($client->createAccount());

// Disabled because we need a real tranaction to retrieve
//print "<br/><br>********************************* Transaction ********************************************<br/><br/>";
//var_dump ($client->getTransaction('30cb85a31c24034abf4e27b8c2a25e0174dfb7520c90f439d9b204feff8cd669'));

// Disabled because we need a real account to send to
//print "<br/><br>******************************** CreditAccount ********************************************<br/><br/>";
//var_dump ($client->creditAccount('326e1a17147ce143e78545d3b4a3b8225061c7f9c7c8d198001c125718a0be7dxx', 0.1));

// Disabled because we need a real address to send to
//print "<br/><br>********************************** Withdraw ********************************************<br/><br/>";
// var_dump ($client->withdraw('kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 0.1));

