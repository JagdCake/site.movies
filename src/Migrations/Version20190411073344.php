<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411073344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE movie ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE movie ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE movie ALTER directors TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER directors DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER top_actors TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER top_actors DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN movie.directors IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN movie.top_actors IS \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movie DROP created_at');
        $this->addSql('ALTER TABLE movie DROP updated_at');
        $this->addSql('ALTER TABLE movie ALTER directors TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER directors DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER top_actors TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER top_actors DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN movie.directors IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN movie.top_actors IS \'(DC2Type:array)\'');
    }
}
