<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190911173203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE tweet ADD COLUMN user_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__tweet AS SELECT id, text, timestamp FROM tweet');
        $this->addSql('DROP TABLE tweet');
        $this->addSql('CREATE TABLE tweet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL, timestamp DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO tweet (id, text, timestamp) SELECT id, text, timestamp FROM __temp__tweet');
        $this->addSql('DROP TABLE __temp__tweet');
    }
}
