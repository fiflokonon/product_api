<?php

namespace App\Domain\Product\Repository;

use PDO;

/**
 * Repository
 */
final class ProductRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array $product
     * @return array|false|string
     */
    public function insertProduct(array $product)
    {
        $row = [
            'name' => $product['name'],
            'price' => $product['price'],
            'user_id' => $product['user_id']
        ];


        $sql = "INSERT INTO products SET
                     name=:name,
                     price=:price,
                     user_id=:user_id;";

        if ($this->connection->prepare($sql)->execute($row)) {
            $id = $this->connection->lastInsertId();
            $req = "SELECT * FROM products WHERE id=$id;";
            $stmt = $this->connection->query($req);
            return $stmt->fetchAll();
        } else {
            return json_encode(["message" => "An error occurs from product creation"]);
        }
    }

    /**
     * @param $id
     * @return false|string
     */
    public function deleteProduct(int $id)
    {
        $sql = "DELETE FROM products WHERE id=$id;";
        if ($this->connection->prepare($sql)->execute()) {
            return json_encode(["message" => "Product deleted"]);
        } else {
            return json_encode(["message" => "An error occurs on product suppression"]);
        }
    }

    /**
     * @return array|false
     */
    public function selectProducts()
    {
        $sql = "SELECT * FROM products;";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function selectProduct(int $id)
    {
        $sql = "SELECT * FROM products WHERE id=$id;";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     * @param array $product
     * @return false|mixed|string
     */
    public function updateProduct(int $id, array $product)
    {
        $row = [
            'name' => $product['name'],
            'price' => $product['price']
        ];
        $sql = "UPDATE products SET 
                    name=:name,
                    price=:price WHERE id=$id;";

        if ($this->connection->prepare($sql)->execute($row)) {
            $req = "SELECT * FROM products WHERE id=$id;";
            $stmt = $this->connection->query($req);
            return $stmt->fetchAll();
        } else {
            return json_encode(['message' => 'An error occurs on update operation']);
        }
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function selectProductsByUser(int $id)
    {
        $sql = "SELECT * FROM products WHERE user_id=$id;";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll();
    }
}
