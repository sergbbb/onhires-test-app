<?php

use Sergbbb\Fin\Factory\AccountFactory;
use Sergbbb\Fin\Interfaces\AccountServiceInterface;
use Sergbbb\Fin\Models\Account;
use Sergbbb\Fin\Models\Transaction;
use Sergbbb\Fin\Services\AccountService;
use Sergbbb\Fin\Services\TransactionService;

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/../vendor/autoload.php';

$transactionService = new TransactionService();
$accountService = new AccountService($transactionService);

function main(AccountServiceInterface $accountService)
{
  $accountsData = [
    [ 'id' => 1, 'name' => 'Serhii Khoroshko', 'balance' => 50 ],
    [ 'id' => 2, 'name' => 'Valeria Khoroshko', 'balance' => 500 ],
    [ 'id' => 3, 'name' => 'Alisia Khoroshko', 'balance' => 5000 ],
  ];

  foreach ($accountsData as $accountData) {
    $accountService->add(AccountFactory::create($accountData['id'], $accountData['name'], $accountData['balance']));
  }

  $allAccounts = $accountService->getAll();

  $serhiiAccount = $accountService->getByIdentifier(1);

  $serhiiBalance = $accountService->getBalanceByIdentifier(1);

  $accountService->makeDeposit(1, 500, 'Quit add');
  $accountService->makeTransfer(1, 2, 10, 'To Wife');
  $accountService->makeTransfer(1, 3, 100, 'To Daughter');
  $accountService->makeWithdraw(1, 100, 'A For Me');

  $sortedByDate = $accountService->getTransactionService()->getTransactionsByAccountId(1);
  $sortedByComment = $accountService->getTransactionService()->getTransactionsByAccountId(1, Transaction::SORT_BY_COMMENT);
}

main($accountService);

