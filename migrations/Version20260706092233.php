<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260706092233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE devlog');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE platform_game');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE topicpost');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE version');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE announcement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE "BINARY", description VARCHAR(255) NOT NULL COLLATE "BINARY", created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_approved BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE badge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE "BINARY", picture_url VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE devlog (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE "BINARY", description DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE "BINARY", description VARCHAR(255) NOT NULL COLLATE "BINARY", meta_description VARCHAR(255) NOT NULL COLLATE "BINARY", download_rate INTEGER NOT NULL, is_approved BOOLEAN NOT NULL, online_game_url VARCHAR(255) NOT NULL COLLATE "BINARY", source_code_url VARCHAR(255) NOT NULL COLLATE "BINARY", browser_version VARCHAR(255) NOT NULL COLLATE "BINARY", requirements VARCHAR(255) NOT NULL COLLATE "BINARY", nb_player_max INTEGER NOT NULL, comment_id INTEGER DEFAULT NULL, image_id INTEGER DEFAULT NULL, devlog_id INTEGER DEFAULT NULL, version_id INTEGER DEFAULT NULL, CONSTRAINT FK_232B318CF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318C3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318CAB9073ED FOREIGN KEY (devlog_id) REFERENCES devlog (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318C4BBC2705 FOREIGN KEY (version_id) REFERENCES version (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_232B318C4BBC2705 ON game (version_id)');
        $this->addSql('CREATE INDEX IDX_232B318CAB9073ED ON game (devlog_id)');
        $this->addSql('CREATE INDEX IDX_232B318C3DA5256D ON game (image_id)');
        $this->addSql('CREATE INDEX IDX_232B318CF8697D13 ON game (comment_id)');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL COLLATE "BINARY", file_type VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE platform_game (platform_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY (platform_id, game_id), CONSTRAINT FK_A72356A0FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A72356A0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A72356A0E48FD905 ON platform_game (game_id)');
        $this->addSql('CREATE INDEX IDX_A72356A0FFE6496F ON platform_game (platform_id)');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE topic (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_title VARCHAR(255) NOT NULL COLLATE "BINARY", created_at DATETIME NOT NULL, topicpost_id INTEGER DEFAULT NULL, CONSTRAINT FK_9D40DE1B11BDD777 FOREIGN KEY (topicpost_id) REFERENCES topicpost (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9D40DE1B11BDD777 ON topic (topicpost_id)');
        $this->addSql('CREATE TABLE topicpost (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_title VARCHAR(255) NOT NULL COLLATE "BINARY", post_description VARCHAR(255) NOT NULL COLLATE "BINARY", created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY", email VARCHAR(255) NOT NULL COLLATE "BINARY", password VARCHAR(255) NOT NULL COLLATE "BINARY", comment_id INTEGER DEFAULT NULL, game_id INTEGER DEFAULT NULL, announcement_id INTEGER DEFAULT NULL, CONSTRAINT FK_8D93D649F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8D93D649913AEA17 ON user (announcement_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E48FD905 ON user (game_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F8697D13 ON user (comment_id)');
        $this->addSql('CREATE TABLE version (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, source_path VARCHAR(255) NOT NULL COLLATE "BINARY", version_number INTEGER NOT NULL)');
    }
}
