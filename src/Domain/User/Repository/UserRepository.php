<?php

namespace App\Domain\User\Repository;

use PDO;
use Slim\Exception\HttpException;

final class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array $userLog
     * @return false|string|void
     */
    public function login(array $userLog)
    {
        $row = [
            'email' => htmlspecialchars($userLog['email']),
        ];
        $sql = "SELECT * FROM users WHERE email=:email;";
        try {
            $stmt = $this->connection->prepare($sql);
            if ($stmt->execute($row)) {
                $user = $stmt->fetch();
                if (isset($user['password']) && isset($userLog['password']) && !empty($user['password']) && !empty($userLog['password'])) {
                    if ($user['password'] == $userLog['password']) {
                        $cookie_name = "user_id";
                        $cookie_value = $user['id'];
                        setcookie($cookie_name, $cookie_value, time() + (84600), "/", "", true, true);
                        return json_encode(['message' => "ok"]);
                    } else {
                        return json_encode(["message" => "Email or password incorrect"]);
                    }
                }
            } else {
                return json_encode(["message" => "Email or password incorrect"]);
            }
        }
        catch (HttpException $exception) {
            // Handle the http exception here
            $statusCode = $exception->getCode();
            $response = $this->responseFactory->createResponse()->withStatus($statusCode);
            $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
            $response->getBody()->write($errorMessage);
            return $response;
        }

    }

    /**
     * @param array $user
     * @return array
     */
    public function insertUser(array $user): array
    {
        $row = [
            'firstName' => htmlspecialchars($user['firstName']),
            'lastName' => htmlspecialchars($user['lastName']),
            'email' => htmlspecialchars($user['email']),
            'password' => htmlspecialchars($user['password']),
        ];

        $sql = "INSERT INTO users SET  
                firstName=:firstName, 
                lastName=:lastName, 
                email=:email,
                password=:password;";
        if ($this->connection->prepare($sql)->execute($row)) {
            return $user;
        } else {
            return json_encode(['message' => "An error occurs during User creation"]);
        }
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        $sql = "SELECT * FROM users;";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function getUser(int $id)
    {
        $sql = "SELECT * FROM users WHERE id=$id;";
        $stmt = $this->connection->query($sql);
        return $stmt->fetch();
    }

    /**
     * @param int $id
     * @return false|string
     */
    public function deleteUser(int $id)
    {
        $sql = "DELETE FROM users WHERE id=$id;";
        if ($this->connection->prepare($sql)->execute()) {
            return json_encode(["message" => "User deleted"]);
        } else {
            return json_encode(["message" => "An error occurs on user suppression"]);
        }
    }

    /**
     * @param int $id
     * @param array $user
     * @return array|false|string
     */
    public function updateUser(int $id, array $user)
    {
        $row = [
            'firstName' => htmlspecialchars($user['firstName']),
            'lastName' => htmlspecialchars($user['lastName']),
            'email' => htmlspecialchars($user['email']),
            'password' => htmlspecialchars($user['password']),
        ];

        $sql = "UPDATE users SET 
                 firstName=:firstName,
                 lastName=:lastName,
                 email=:email,
                 passwor=:password WHERE id=$id;";

        if ($this->connection->prepare($sql)->execute($row)) {
            $req = "SELECT * FROM users WHERE id=$id;";
            $stmt = $this->connection->query($req);
            return $stmt->fetchAll();
        } else {
            return json_encode(['message' => 'An error occurs on update operation']);
        }
    }

}