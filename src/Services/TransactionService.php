<?php


namespace Sergbbb\Fin\Services;


use Sergbbb\Fin\Interfaces\TransactionServiceInterface;
use Sergbbb\Fin\Models\Transaction;

class TransactionService implements TransactionServiceInterface
{

  /**
   * @var Transaction[]
   */
  protected array $transactions = [];

  protected int $transactionIterator = 1;

  public function add(Transaction $model)
  {
    $model->setId($this->transactionIterator++);
    $model->setDueDate(time());
    $this->transactions[] = $model;
  }

  public function getByIdentifier($identifier) : Transaction | null
  {
    foreach ($this->transactions as $transaction) {
      if ($transaction->getIdentifierValue() == $identifier) {
        return $transaction;
      }
    }
    return null;
  }

  public function getAll(): array
  {
    return $this->transactions;
  }

  public function getTransactionsByAccountId($accountId, $sortBy = Transaction::SORT_BY_DATE): array
  {
    $result = [];
    foreach ($this->transactions as $transaction) {
      if ($transaction->getAccountId() == $accountId) {
        $result[] = $transaction;
      }
    }

    usort($result, function (Transaction $a, Transaction $b) use ($sortBy) {
      switch ($sortBy) {
        case Transaction::SORT_BY_COMMENT:
          return strtolower($a->getComment()) <=> strtolower($b->getComment());

        case Transaction::SORT_BY_DATE:
        default:
          if ($a->getDueDate() == $b->getDueDate()) {
            return 0;
          }
          return ($a->getDueDate() < $b->getDueDate()) ? -1 : 1;
          break;
      }
    });

    return $result;
  }
}