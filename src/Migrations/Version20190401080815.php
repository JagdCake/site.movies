<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401080815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, imdb_id VARCHAR(9) NOT NULL, title VARCHAR(100) NOT NULL, year_of_release SMALLINT NOT NULL, runtime SMALLINT NOT NULL, genre VARCHAR(100) NOT NULL, imdb_rating DECIMAL(2,1) NOT NULL, directors TEXT NOT NULL, top_actors TEXT NOT NULL, my_rating VARCHAR(30) NOT NULL, watched_on DATE DEFAULT NULL, discussion TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN movie.directors IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN movie.top_actors IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE movie_id_seq CASCADE');
        $this->addSql('DROP TABLE movie');
    }
}
