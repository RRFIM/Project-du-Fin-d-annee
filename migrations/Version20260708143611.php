<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260708143611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE announcement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_approved BOOLEAN NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_4DB9D91CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4DB9D91CA76ED395 ON announcement (user_id)');
        $this->addSql('CREATE TABLE badge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, picture_url VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL, user_id INTEGER NOT NULL, game_id INTEGER NOT NULL, CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526CE48FD905 ON comment (game_id)');
        $this->addSql('CREATE TABLE devlog (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, game_id INTEGER NOT NULL, CONSTRAINT FK_4D5F5A45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4D5F5A45E48FD905 ON devlog (game_id)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, meta_description VARCHAR(255) NOT NULL, download_rate INTEGER NOT NULL, is_approved BOOLEAN NOT NULL, online_game_url VARCHAR(255) NOT NULL, source_code_url VARCHAR(255) NOT NULL, browser_version VARCHAR(255) NOT NULL, requirements VARCHAR(255) NOT NULL, nb_player_max INTEGER NOT NULL, submitter_id INTEGER NOT NULL, uploads_id INTEGER NOT NULL, CONSTRAINT FK_232B318C919E5513 FOREIGN KEY (submitter_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_232B318CB66372A5 FOREIGN KEY (uploads_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_232B318C919E5513 ON game (submitter_id)');
        $this->addSql('CREATE INDEX IDX_232B318CB66372A5 ON game (uploads_id)');
        $this->addSql('CREATE TABLE favorite (game_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY (game_id, user_id), CONSTRAINT FK_68C58ED9E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_68C58ED9E48FD905 ON favorite (game_id)');
        $this->addSql('CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)');
        $this->addSql('CREATE TABLE wishlist (game_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY (game_id, user_id), CONSTRAINT FK_9CE12A31E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9CE12A31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9CE12A31E48FD905 ON wishlist (game_id)');
        $this->addSql('CREATE INDEX IDX_9CE12A31A76ED395 ON wishlist (user_id)');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL, file_type VARCHAR(255) NOT NULL, game_id INTEGER DEFAULT NULL, CONSTRAINT FK_C53D045FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C53D045FE48FD905 ON image (game_id)');
        $this->addSql('CREATE TABLE platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL, game_id INTEGER NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_794381C6E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_794381C6E48FD905 ON review (game_id)');
        $this->addSql('CREATE INDEX IDX_794381C6A76ED395 ON review (user_id)');
        $this->addSql('CREATE TABLE topic (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_9D40DE1BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9D40DE1BA76ED395 ON topic (user_id)');
        $this->addSql('CREATE TABLE topicpost (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_title VARCHAR(255) NOT NULL, post_description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, topic_id INTEGER NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_244204D51F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_244204D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_244204D51F55203D ON topicpost (topic_id)');
        $this->addSql('CREATE INDEX IDX_244204D5A76ED395 ON topicpost (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, is_subscribed_to_newsletter BOOLEAN NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, picture_url VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user_badge (user_id INTEGER NOT NULL, badge_id INTEGER NOT NULL, PRIMARY KEY (user_id, badge_id), CONSTRAINT FK_1C32B345A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1C32B345F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1C32B345A76ED395 ON user_badge (user_id)');
        $this->addSql('CREATE INDEX IDX_1C32B345F7A2C2FC ON user_badge (badge_id)');
        $this->addSql('CREATE TABLE download (user_id INTEGER NOT NULL, game_id INTEGER NOT NULL, PRIMARY KEY (user_id, game_id), CONSTRAINT FK_781A8270A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_781A8270E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_781A8270A76ED395 ON download (user_id)');
        $this->addSql('CREATE INDEX IDX_781A8270E48FD905 ON download (game_id)');
        $this->addSql('CREATE TABLE version (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, source_path VARCHAR(255) NOT NULL, version_number INTEGER NOT NULL, game_id INTEGER NOT NULL, CONSTRAINT FK_BF1CD3C3E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BF1CD3C3E48FD905 ON version (game_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE devlog');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE topicpost');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_badge');
        $this->addSql('DROP TABLE download');
        $this->addSql('DROP TABLE version');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
