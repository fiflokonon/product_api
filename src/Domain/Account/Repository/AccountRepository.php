<?php

namespace App\Domain\Account\Repository;

use PDO;
use Slim\Exception\HttpException;
use Psr\Http\Message\ResponseFactoryInterface;

final class AccountRepository
{
    /**
     * @var PDO
     */
  private PDO $connection;
    /**
     * @var ResponseFactoryInterface
     */
  private ResponseFactoryInterface $factory;

    /**
     * @param PDO $connection
     */
  public function __construct(PDO $connection, ResponseFactoryInterface $factory)
  {
      $this->connection = $connection;
      $this->factory = $factory;
  }

    /**
     * @param int $id
     * @return false|\Psr\Http\Message\ResponseInterface|string
     */
  public function newAccount(int $id)
  {
      $rep = $this->checkAccountExist($id);
      try {
          if ($rep)
          {
              $sql = "INSERT INTO accounts(balance, user_id) VALUES (00, $id);";
              return $this->extracted($sql);
          }
          else
          {
              return json_encode(["message" => "You had already an account"]);
          }
      }
      catch (HttpException $exception)
      {
          $statusCode = $exception->getCode();
          $response = $this->factory->createResponse()->withStatus($statusCode);
          $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
          $response->getBody()->write($errorMessage);
          return $response;
      }
  }

    /**
     * @return array
     */
  public function getAccounts(): array
  {
      $sql = "SELECT * FROM accounts;";
      try {
          $stmt = $this->connection->query($sql);
          return $stmt->fetchAll();
      }
      catch (HttpException $exception)
      {
          $statusCode = $exception->getCode();
          $response = $this->factory->createResponse()->withStatus($statusCode);
          $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
          $response->getBody()->write($errorMessage);
          return $response;
      }
  }

    /**
     * @param int $id
     * @return false|\Psr\Http\Message\ResponseInterface|string
     */
  public function getAccount(int $id)
  {
      $sql = "SELECT * FROM accounts WHERE id=$id;";
      try
      {
          $stmt = $this->connection->query($sql);
          return $stmt->fetch();
      }
      catch (HttpException $exception)
      {
          $statusCode = $exception->getCode();
          $response = $this->factory->createResponse()->withStatus($statusCode);
          $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
          $response->getBody()->write($errorMessage);
          return $response;
      }
  }

    /**
     * @param int $id
     * @return false|\Psr\Http\Message\ResponseInterface|string
     */
  public function deleteAccount(int $id)
  {
      $sql = "DELETE FROM accounts WHERE id=$id;";
      return $this->extracted($sql);
  }

    /**
     * @param int $id
     * @param int $amount
     * @return string[]
     */
  public function addAmount(int $id, int $amount)
  {
      $old = $this->getAccount($id);
      if ($amount < 0)
      {
          return (['message' => "Invalid amount"]);
      }
      else
      {
          $new = $old['balance'] + $amount;
          $sql = "UPDATE accounts SET balance=$new WHERE id=$id;";
          return $this->extracted($sql);
      }

  }

    /**
     * @param int $id
     * @param int $amount
     * @return false|mixed|\Psr\Http\Message\ResponseInterface|string
     */
  public function subAmount(int $id, int $amount)
  {
      $old = $this->getAccount($id);
      if ($amount > $old['balance'])
      {
          return (['message' => "Insufficient balance"]);
      }
      elseif ($amount < 0)
      {
          return (['message' => "Invalid amount"]);
      }
      else
      {
          try {
              $new = $old['balance'] - $amount;
              $sql = "UPDATE accounts SET balance=$new WHERE id=$id;";
              if ($this->connection->prepare($sql)->execute())
              {
                  $req = "SELECT * FROM accounts WHERE id=$id;";
                  $stmt = $this->connection->query($req);
                  return $stmt->fetch();
              }
              else
              {
                  return (['success' => false]);
              }
          }
          catch (HttpException $exception) {
              $statusCode = $exception->getCode();
              $response = $this->factory->createResponse()->withStatus($statusCode);
              $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
              $response->getBody()->write($errorMessage);
              return $response;
          }
      }
  }

    /**
     * @param int $id
     * @return bool|\Psr\Http\Message\ResponseInterface|void
     */
  public function checkAccountExist(int $id)
  {
      $sql = "SELECT * FROM accounts WHERE user_id=$id;";
      $stmt = $this->connection->prepare($sql);
      if ($stmt->execute())
      {
          $result = $stmt->fetch();
          if (empty($result))
          {
              return true;
          }
          else
          {
              return false;
          }
      }
  }
    /**
     * @param string $sql
     * @return \Psr\Http\Message\ResponseInterface|string|false
     */
  public function extracted(string $sql): \Psr\Http\Message\ResponseInterface|string|false
  {
        try {
            if ($this->connection->prepare($sql)->execute()) {
                return json_encode(['success' => true]);
            } else {
                return json_encode(['success' => false]);
            }
        } catch (HttpException $exception) {
            $statusCode = $exception->getCode();
            $response = $this->factory->createResponse()->withStatus($statusCode);
            $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
            $response->getBody()->write($errorMessage);
            return $response;
        }
    }
}