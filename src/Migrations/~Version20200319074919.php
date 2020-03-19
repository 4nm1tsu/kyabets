<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319074919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, nickname VARCHAR(255) DEFAULT NULL, contribution INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE TABLE bbs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, contents VARCHAR(1023) NOT NULL, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2AD5EFFFA76ED395 ON bbs (user_id)');
        $this->addSql('CREATE TABLE reply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bbs_id INTEGER NOT NULL, user_id INTEGER NOT NULL, contents VARCHAR(1023) NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0F786388F ON reply (bbs_id)');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0A76ED395 ON reply (user_id)');
        $this->addSql('CREATE TABLE badge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FEF0481DA76ED395 ON badge (user_id)');
        $this->addSql('CREATE TABLE archive (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, archive_name VARCHAR(255) NOT NULL, archive_size INTEGER NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('
CREATE TABLE `rememberme_token` (
    `series`   char(88)     UNIQUE PRIMARY KEY NOT NULL,
    `value`    char(88)     NOT NULL,
    `lastUsed` datetime     NOT NULL,
    `class`    varchar(100) NOT NULL,
    `username` varchar(200) NOT NULL
)
        ');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE bbs');
        $this->addSql('DROP TABLE reply');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE archive');
        $this->addSql('DROP TABLE rememberme_token');
    }
}
