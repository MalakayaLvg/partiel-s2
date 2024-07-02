<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702094423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD salle_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD jour_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD horaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE2258C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8244BE22DC304035 ON film (salle_id)');
        $this->addSql('CREATE INDEX IDX_8244BE22220C6AD0 ON film (jour_id)');
        $this->addSql('CREATE INDEX IDX_8244BE2258C54515 ON film (horaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE22DC304035');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE22220C6AD0');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE2258C54515');
        $this->addSql('DROP INDEX IDX_8244BE22DC304035');
        $this->addSql('DROP INDEX IDX_8244BE22220C6AD0');
        $this->addSql('DROP INDEX IDX_8244BE2258C54515');
        $this->addSql('ALTER TABLE film DROP salle_id');
        $this->addSql('ALTER TABLE film DROP jour_id');
        $this->addSql('ALTER TABLE film DROP horaire_id');
    }
}
