<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307065036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE reply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bbs_id INTEGER NOT NULL, user_id INTEGER NOT NULL, contents VARCHAR(1023) NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0F786388F ON reply (bbs_id)');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0A76ED395 ON reply (user_id)');
        $this->addSql('CREATE TABLE badge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FEF0481DA76ED395 ON badge (user_id)');
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('CREATE TEMPORARY TABLE __temp__bbs AS SELECT id, contents, date, type FROM bbs');
        $this->addSql('DROP TABLE bbs');
        $this->addSql('CREATE TABLE bbs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, contents VARCHAR(1023) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL, CONSTRAINT FK_2AD5EFFFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO bbs (id, contents, date, type) SELECT id, contents, date, type FROM __temp__bbs');
        $this->addSql('DROP TABLE __temp__bbs');
        $this->addSql('CREATE INDEX IDX_2AD5EFFFA76ED395 ON bbs (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE BINARY, value CHAR(88) NOT NULL COLLATE BINARY, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE BINARY, username VARCHAR(200) NOT NULL COLLATE BINARY, PRIMARY KEY(series))');
        $this->addSql('DROP TABLE reply');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP INDEX IDX_2AD5EFFFA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__bbs AS SELECT id, contents, date, type FROM bbs');
        $this->addSql('DROP TABLE bbs');
        $this->addSql('CREATE TABLE bbs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contents VARCHAR(1023) NOT NULL, date DATETIME NOT NULL, type INTEGER NOT NULL, writtenby VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO bbs (id, contents, date, type) SELECT id, contents, date, type FROM __temp__bbs');
        $this->addSql('DROP TABLE __temp__bbs');
    }
}
