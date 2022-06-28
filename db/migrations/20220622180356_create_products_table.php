<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProductsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->table('products')
            ->addColumn('name', 'string')
            ->addColumn('price', 'integer')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id',
                options: ['delete' => "CASCADE", "update" => "CASCADE"])
            ->addIndex('name', ['unique' => true])
            ->create();
    }

    public function down()
    {

    }
}
