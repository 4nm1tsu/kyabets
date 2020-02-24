<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200224044714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE badge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FEF0481DA76ED395 ON badge (user_id)');
        $this->addSql('DROP TABLE rememberme_token');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE BINARY, value CHAR(88) NOT NULL COLLATE BINARY, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE BINARY, username VARCHAR(200) NOT NULL COLLATE BINARY, PRIMARY KEY(series))');
        $this->addSql('DROP TABLE badge');
    }
}
