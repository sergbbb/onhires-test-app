<?php


namespace Sergbbb\Fin\Factory;


use Sergbbb\Fin\Models\Transaction;

class TransactionFactory
{
  public static function create($accountId, $type, $amount = 0, $comment = '')
  {
    $transaction = new Transaction();
    $transaction->setAccountId($accountId);
    $transaction->setType($type);
    $transaction->setAmount($amount);
    $transaction->setComment($comment);
    return $transaction;
  }
}