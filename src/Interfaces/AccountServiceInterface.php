<?php


namespace Sergbbb\Fin\Interfaces;


use Sergbbb\Fin\Models\Account;

interface AccountServiceInterface extends BaseServiceInterface
{
  public function add(Account $model);
  public function getTransactionService();
  public function getBalanceByIdentifier($identifier);
  public function makeDeposit($identifier, $amount, $comment = '');
  public function makeWithdraw($identifier, $amount, $comment = '');
  public function makeTransfer($fromIdentifier, $toIdentifier, $amount, $comment = '');
}