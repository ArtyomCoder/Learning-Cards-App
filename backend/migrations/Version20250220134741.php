<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220134741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE note');
        $this->addSql('CREATE TEMPORARY TABLE __temp__card AS SELECT id, deck_id, front, back FROM card');
        $this->addSql('DROP TABLE card');
        $this->addSql('CREATE TABLE card (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deck_id INTEGER DEFAULT NULL, front VARCHAR(255) NOT NULL, back VARCHAR(255) NOT NULL, CONSTRAINT FK_161498D3111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO card (id, deck_id, front, back) SELECT id, deck_id, front, back FROM __temp__card');
        $this->addSql('DROP TABLE __temp__card');
        $this->addSql('CREATE INDEX IDX_161498D3111948DC ON card (deck_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__deck AS SELECT id, title, description FROM deck');
        $this->addSql('DROP TABLE deck');
        $this->addSql('CREATE TABLE deck (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO deck (id, title, description) SELECT id, title, description FROM __temp__deck');
        $this->addSql('DROP TABLE __temp__deck');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, note_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE "BINARY", content CLOB NOT NULL COLLATE "BINARY", CONSTRAINT FK_5BF5455826ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5BF5455826ED0855 ON field (note_id)');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deck_id INTEGER DEFAULT NULL, CONSTRAINT FK_CFBDFA14111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14111948DC ON note (deck_id)');
        $this->addSql('ALTER TABLE card ADD COLUMN title VARCHAR(255) NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__deck AS SELECT id, title, description FROM deck');
        $this->addSql('DROP TABLE deck');
        $this->addSql('CREATE TABLE deck (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO deck (id, title, description) SELECT id, title, description FROM __temp__deck');
        $this->addSql('DROP TABLE __temp__deck');
    }
}
