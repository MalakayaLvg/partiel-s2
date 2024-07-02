<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702075008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN image.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F567F5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C53D045F567F5183 ON image (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F567F5183');
        $this->addSql('DROP INDEX IDX_C53D045F567F5183');
        $this->addSql('ALTER TABLE image DROP film_id');
        $this->addSql('ALTER TABLE image DROP image_name');
        $this->addSql('ALTER TABLE image DROP image_size');
        $this->addSql('ALTER TABLE image DROP updated_at');
    }
}
