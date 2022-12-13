<?php


namespace Sergbbb\Fin\Factory;


use Sergbbb\Fin\Models\Account;

class AccountFactory
{
  public static function create($id, $name, $balance = 0)
  {
    $account = new Account();
    $account->setId($id);
    $account->setName($name);
    $account->setBalance($balance);
    return $account;
  }

}