<?php


namespace Sergbbb\Fin\Models;


class Account extends BaseModel
{

  /**
   * Account name
   *
   * @var string
   */
  protected string $name;

  /**
   * Account balance
   *
   * @var float
   */
  protected float $balance;

  public function setName($value)
  {
    $this->name = $value;
  }

  public function setBalance($value)
  {
    $this->balance = $value;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getBalance(): float
  {
    return $this->balance;
  }

}