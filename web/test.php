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
var_dump ($client->userSummaryGet());

print "<br/><br>********************************* Addresses *********************************************<br/><br/>";
var_dump ($client->userAddressesGet());

print "<br/><br>********************************** Balance **********************************************<br/><br/>";
var_dump ($client->userBalanceGet());

print "<br/><br>********************************** Deposits *********************************************<br/><br/>";
var_dump ($client->userDepositsGet());

print "<br/><br>******************************** Transactions *******************************************<br/><br/>";
var_dump ($client->userTransactionsGet());

print "<br/><br>********************************** Withdraws ********************************************<br/><br/>";
var_dump ($client->userWithdrawsGet());

print "<br/><br>********************************* NewAddress ********************************************<br/><br/>";
var_dump ($client->userAddressCreate());

print "<br/><br>******************************** CreateAccount ********************************************<br/><br/>";
var_dump ($client->adminAccountCreate());





// Disabled because we need a real tranaction to retrieve
//print "<br/><br>********************************* Transaction ********************************************<br/><br/>";
//var_dump ($client->userTransactionGet('30cb85a31c24034abf4e27b8c2a25e0174dfb7520c90f439d9b204feff8cd669'));

// Disabled because we need a real account to credit
//print "<br/><br>******************************** CreditAccount ********************************************<br/><br/>";
//var_dump ($client->adminAccountCredit('326e1a17147ce143e78545d3b4a3b8225061c7f9c7c8d198001c125718a0be7dxx', 0.1));

// Disabled because we need a real account to debit
//print "<br/><br>******************************** DebitAccount ********************************************<br/><br/>";
//var_dump ($client->adminAccountDebit('326e1a17147ce143e78545d3b4a3b8225061c7f9c7c8d198001c125718a0be7dxx', 0.1));

// Disabled because we need a real account to reset
//print "<br/><br>******************************** ResetAccount ********************************************<br/><br/>";
//var_dump ($client->adminAccountReset('326e1a17147ce143e78545d3b4a3b8225061c7f9c7c8d198001c125718a0be7dxx', 0.1));

// Disabled because we need a real address to send to
//print "<br/><br>********************************** Withdraw ********************************************<br/><br/>";
//var_dump ($client->userWithdraw('kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 0.1));

// Disabled because we need a real account to check
//print "<br/><br>******************************* DepositsAccount ******************************************<br/><br/>";
//var_dump ($client->adminAccountDepositsSum('42552082ce4f42a42a6adaa4f6f03be226508417d2ed7f1147f0b8d03a0599e1'));

// Disabled because we need a real account to check
//print "<br/><br>******************************* WithdrawsAccount ******************************************<br/><br/>";
//var_dump ($client->adminAccountWithdrawsSum('42552082ce4f42a42a6adaa4f6f03be226508417d2ed7f1147f0b8d03a0599e1'));

// Disabled because we need a real account to check
//print "<br/><br>******************************* WithdrawsAvailable ******************************************<br/><br/>";
//var_dump ($client->adminAccountWithdrawAvailable('42552082ce4f42a42a6adaa4f6f03be226508417d2ed7f1147f0b8d03a0599e1'));
