<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221173724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__bbs AS SELECT id, contents, date, writtenby, type FROM bbs');
        $this->addSql('DROP TABLE bbs');
        $this->addSql('CREATE TABLE bbs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contents VARCHAR(1023) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, type INTEGER NOT NULL, writtenby VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO bbs (id, contents, date, writtenby, type) SELECT id, contents, date, writtenby, type FROM __temp__bbs');
        $this->addSql('DROP TABLE __temp__bbs');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__bbs AS SELECT id, contents, date, writtenby, type FROM bbs');
        $this->addSql('DROP TABLE bbs');
        $this->addSql('CREATE TABLE bbs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contents VARCHAR(1023) NOT NULL, date DATETIME NOT NULL, type INTEGER NOT NULL, writtenby INTEGER NOT NULL)');
        $this->addSql('INSERT INTO bbs (id, contents, date, writtenby, type) SELECT id, contents, date, writtenby, type FROM __temp__bbs');
        $this->addSql('DROP TABLE __temp__bbs');
    }
}
