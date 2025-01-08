<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250106202535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Criação de uma tabela de testes';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('testes');

        $table->addColumn('id', 'integer')->setAutoincrement(true);
        $table->addColumn('teste', 'string');

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('testes');
    }
}
