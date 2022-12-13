<?php


namespace Sergbbb\Fin\Models;


class Transaction extends BaseModel
{

  const DEPOSIT_TYPE = 1;
  const WITHDRAW_TYPE = 2;
  const TRANSFER_TYPE = 3;

  const SORT_BY_DATE = 'dueDate';
  const SORT_BY_COMMENT = 'comment';

  /**
   * Account identifier of transaction
   *
   * @var int
   */
  protected int $accountId;

  /**
   * Account identifier of transaction
   *
   * @var int
   */
  protected int $type;

  /**
   * @var string
   */
  protected string $comment;

  /**
   * @var float
   */
  protected float $amount;

  /**
   * @var int
   */
  protected int $dueDate;

  public function setAccountId($value)
  {
    $this->accountId = $value;
  }

  public function setType($value)
  {
    $this->type = $value;
  }

  public function setComment($value)
  {
    $this->comment = $value;
  }

  public function setAmount($value)
  {
    $this->amount = $value;
  }

  public function setDueDate($value)
  {
    $this->dueDate = $value;
  }

  public function getAccountId(): int
  {
    return $this->accountId;
  }

  public function getType(): int
  {
    return $this->type;
  }

  public function getComment(): string
  {
    return $this->comment;
  }

  public function getAmount(): float
  {
    return $this->amount;
  }

  public function getDueDate(): int
  {
    return $this->dueDate;
  }

}