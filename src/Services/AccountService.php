<?php


namespace Sergbbb\Fin\Services;


use Sergbbb\Fin\Factory\TransactionFactory;
use Sergbbb\Fin\Interfaces\AccountServiceInterface;
use Sergbbb\Fin\Interfaces\TransactionServiceInterface;
use Sergbbb\Fin\Models\Account;
use Sergbbb\Fin\Models\Transaction;

class AccountService implements AccountServiceInterface
{

  /**
   * @var Account[]
   */
  protected array $accounts = [];

  /**
   * @var TransactionService
   */
  protected TransactionService $transactionService;

  public function __construct(TransactionServiceInterface $transactionService)
  {
    $this->transactionService = $transactionService;
  }

  public function getTransactionService()
  {
    return $this->transactionService;
  }

  /**
   * @throws \Exception
   */
  public function add(Account $model)
  {
    $this->validate($model);

    if ($this->getByIdentifier($model->getIdentifierValue())) {
      throw new \Exception('Account with such identifier exists in DB');
    }

    $this->accounts[] = $model;
  }

  public function getByIdentifier($identifier) : Account | null
  {
    foreach ($this->accounts as $account) {
      if ($account->getIdentifierValue() == $identifier) {
        return $account;
      }
    }
    return null;
  }

  public function getAll(): array
  {
    return $this->accounts;
  }

  public function getBalanceByIdentifier($identifier)
  {
    $account = $this->getByIdentifier($identifier);

    if (!$account) {
      throw new \Exception('No Account with such identifier');
    }

    return $account->getBalance();
  }

  /**
   * @throws \Exception
   */
  public function makeDeposit($identifier, $amount, $comment = '')
  {
    $account = $this->getByIdentifier($identifier);

    if ($amount < 0) {
      throw new \Exception('Wrong amount');
    }

    if (!$account) {
      throw new \Exception('No Account with such identifier');
    }

    $account->setBalance($account->getBalance() + $amount);

    $this->transactionService->add(
      TransactionFactory::create($account->getId(), Transaction::DEPOSIT_TYPE, $amount, $comment)
    );

  }

  /**
   * @throws \Exception
   */
  public function makeWithdraw($identifier, $amount, $comment = '')
  {
    $account = $this->getByIdentifier($identifier);

    if ($amount < 0) {
      throw new \Exception('Wrong amount');
    }

    if (!$account) {
      throw new \Exception('No Account with such identifier');
    }

    if ($account->getBalance() < $amount) {
      throw new \Exception('Not enough balance for this operation');
    }

    $account->setBalance($account->getBalance() - $amount);

    $this->transactionService->add(
      TransactionFactory::create($account->getId(), Transaction::WITHDRAW_TYPE, $amount, $comment)
    );
  }

  public function makeTransfer($fromIdentifier, $toIdentifier, $amount, $comment = '')
  {
    $accountFrom = $this->getByIdentifier($fromIdentifier);
    $accountTo = $this->getByIdentifier($toIdentifier);

    if ($amount < 0) {
      throw new \Exception('Wrong amount');
    }

    if (!$accountFrom) {
      throw new \Exception('No From Account with such identifier');
    }

    if (!$accountTo) {
      throw new \Exception('No To Account with such identifier');
    }

    if ($accountFrom->getBalance() < $amount) {
      throw new \Exception('Not enough balance for this operation');
    }

    $accountFrom->setBalance($accountFrom->getBalance() - $amount);
    $accountTo->setBalance($accountTo->getBalance() + $amount);

    $this->transactionService->add(
      TransactionFactory::create($accountFrom->getId(), Transaction::TRANSFER_TYPE, -1 * $amount, $comment)
    );

    $this->transactionService->add(
      TransactionFactory::create($accountTo->getId(), Transaction::TRANSFER_TYPE, $amount, $comment)
    );
  }

  protected function validate(Account $account): bool
  {
    if ($account->getBalance() < 0) {
      throw new \Exception('Account balance should be more than 0');
    }

    return true;
  }


}