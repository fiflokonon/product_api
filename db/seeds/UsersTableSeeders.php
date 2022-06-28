<?php


use Phinx\Seed\AbstractSeed;

class UsersTableSeeders extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here=>
     * https=>//book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {


        $data = [
            [
                "lastName" => "AFISSOU",
                "firstName" => "Alaé",
                "email" => "afi@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "LOKONON",
                "firstName" => "Arnaud",
                "email" => "fif@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "AFISSOU",
                "firstName" => "Riyad",
                "email" => "ryd@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "WALKER",
                "firstName" => "Paul",
                "email" => "apd@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "DIESEL",
                "firstName" => "Vin",
                "email" => "vin@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "JACKSON",
                "firstName" => "Curtis",
                "email" => "jac@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "JACKSON",
                "firstName" => "Shana",
                "email" => "sha@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "IVANOV",
                "firstName" => "Alana",
                "email" => "ala@gmail.com",
                "password" => "12345"
            ],
            [
                "lastName" => "ALISSOU",
                "firstName" => "Fernando",
                "email" => "fern@gmail.com",
                "password" => "12345"
            ]
        ];

        $this->insert('users', $data);
    }
}
