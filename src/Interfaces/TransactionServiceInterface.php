<?php


namespace Sergbbb\Fin\Interfaces;


use Sergbbb\Fin\Models\Transaction;

interface TransactionServiceInterface extends BaseServiceInterface
{
  public function add(Transaction $model);
  public function getTransactionsByAccountId($accountId, $sortBy);

}