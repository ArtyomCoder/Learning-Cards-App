<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219123633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__card AS SELECT id, front, back, title FROM card');
        $this->addSql('DROP TABLE card');
        $this->addSql('CREATE TABLE card (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, front CLOB NOT NULL, back CLOB NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO card (id, front, back, title) SELECT id, front, back, title FROM __temp__card');
        $this->addSql('DROP TABLE __temp__card');
        $this->addSql('CREATE TEMPORARY TABLE __temp__deck AS SELECT id, title, description FROM deck');
        $this->addSql('DROP TABLE deck');
        $this->addSql('CREATE TABLE deck (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO deck (id, title, description) SELECT id, title, description FROM __temp__deck');
        $this->addSql('DROP TABLE __temp__deck');
        $this->addSql('CREATE TEMPORARY TABLE __temp__field AS SELECT id, title, content FROM field');
        $this->addSql('DROP TABLE field');
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO field (id, title, content) SELECT id, title, content FROM __temp__field');
        $this->addSql('DROP TABLE __temp__field');
        $this->addSql('CREATE TEMPORARY TABLE __temp__note AS SELECT id FROM note');
        $this->addSql('DROP TABLE note');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO note (id) SELECT id FROM __temp__note');
        $this->addSql('DROP TABLE __temp__note');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__card AS SELECT id, title, front, back FROM card');
        $this->addSql('DROP TABLE card');
        $this->addSql('CREATE TABLE card (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deck_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, front VARCHAR(255) NOT NULL, back VARCHAR(255) NOT NULL, CONSTRAINT FK_161498D3111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO card (id, title, front, back) SELECT id, title, front, back FROM __temp__card');
        $this->addSql('DROP TABLE __temp__card');
        $this->addSql('CREATE INDEX IDX_161498D3111948DC ON card (deck_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__deck AS SELECT id, title, description FROM deck');
        $this->addSql('DROP TABLE deck');
        $this->addSql('CREATE TABLE deck (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO deck (id, title, description) SELECT id, title, description FROM __temp__deck');
        $this->addSql('DROP TABLE __temp__deck');
        $this->addSql('CREATE TEMPORARY TABLE __temp__field AS SELECT id, title, content FROM field');
        $this->addSql('DROP TABLE field');
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, note_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, CONSTRAINT FK_5BF5455826ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO field (id, title, content) SELECT id, title, content FROM __temp__field');
        $this->addSql('DROP TABLE __temp__field');
        $this->addSql('CREATE INDEX IDX_5BF5455826ED0855 ON field (note_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__note AS SELECT id FROM note');
        $this->addSql('DROP TABLE note');
        $this->addSql('CREATE TABLE note (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deck_id INTEGER DEFAULT NULL, CONSTRAINT FK_CFBDFA14111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO note (id) SELECT id FROM __temp__note');
        $this->addSql('DROP TABLE __temp__note');
        $this->addSql('CREATE INDEX IDX_CFBDFA14111948DC ON note (deck_id)');
    }
}
