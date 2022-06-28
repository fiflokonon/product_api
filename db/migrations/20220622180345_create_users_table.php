<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
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
        $this->table('users')
            ->addColumn('firstName', 'string')
            ->addColumn('lastName', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addIndex('email', ['unique' => true])
            ->create();

        /*$this->table('products')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id')->update();*/

        /*$this->table('accounts')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id')->update();*/
    }

    public function down()
    {

    }
}
