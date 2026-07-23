<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260709142642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, is_subscribed_to_newsletter, email, password, firstname, lastname, picture_url, status FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, is_subscribed_to_newsletter BOOLEAN, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255), lastname VARCHAR(255), picture_url VARCHAR(255), status VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, roles CLOB NOT NULL)');
        $this->addSql('INSERT INTO user (id, is_subscribed_to_newsletter, email, password, firstname, lastname, picture_url, status) SELECT id, is_subscribed_to_newsletter, email, password, firstname, lastname, picture_url, status FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, is_subscribed_to_newsletter, email, firstname, lastname, picture_url, password, status FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, is_subscribed_to_newsletter BOOLEAN NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, picture_url VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, is_subscribed_to_newsletter, email, firstname, lastname, picture_url, password, status) SELECT id, is_subscribed_to_newsletter, email, firstname, lastname, picture_url, password, status FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
