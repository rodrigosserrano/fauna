<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AlteracaoFotoUsuarioAnimal extends AbstractMigration
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
    public function change(): void
    {   //altera o nome da coluna para foto_usuario
        $this->execute("ALTER TABLE usuario CHANGE COLUMN foto foto_usuario  varchar(100)");

        //altera o nome da coluna para foto_animal
         $this->execute("ALTER TABLE animal CHANGE COLUMN foto TO foto_animal varchar(100)");
    }
}
