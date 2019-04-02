<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402121623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE movie ALTER imdb_rating TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE movie ALTER imdb_rating DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER watched_on TYPE VARCHAR(11)');
        $this->addSql('ALTER TABLE movie ALTER watched_on SET NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER discussion SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movie ALTER imdb_rating TYPE NUMERIC(2, 1)');
        $this->addSql('ALTER TABLE movie ALTER imdb_rating DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER watched_on TYPE CHAR(11)');
        $this->addSql('ALTER TABLE movie ALTER watched_on DROP NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER discussion DROP NOT NULL');
    }
}
