<?php


use Phinx\Seed\AbstractSeed;

class ProductsTableSeeders extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $datas = [
            [
                "name" => "mais",
                "price" => "900",
                "user_id" => 1
            ],
            [
                "name" => "Foufou",
                "price" => "4200",
                "user_id" => 1
            ],
            [
                "name" => "Banana",
                "price" => "800",
                "user_id" => 1
            ]
        ];
        $this->insert('products', $datas);
    }
}
