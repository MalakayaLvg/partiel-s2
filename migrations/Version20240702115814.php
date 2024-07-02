<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702115814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_method_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, customer_id INT NOT NULL, payment_method_id INT NOT NULL, status INT NOT NULL, delivery_status INT NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('CREATE INDEX IDX_F52993985AA1164F ON "order" (payment_method_id)');
        $this->addSql('CREATE TABLE order_items (id INT NOT NULL, film_id INT DEFAULT NULL, of_order_id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62809DB0567F5183 ON order_items (film_id)');
        $this->addSql('CREATE INDEX IDX_62809DB031049BD3 ON order_items (of_order_id)');
        $this->addSql('CREATE TABLE payment_method (id INT NOT NULL, owner_id INT NOT NULL, card_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B61A1F67E3C61F9 ON payment_method (owner_id)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993985AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB0567F5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB031049BD3 FOREIGN KEY (of_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_method ADD CONSTRAINT FK_7B61A1F67E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE order_items_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_method_id_seq CASCADE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993985AA1164F');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT FK_62809DB0567F5183');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT FK_62809DB031049BD3');
        $this->addSql('ALTER TABLE payment_method DROP CONSTRAINT FK_7B61A1F67E3C61F9');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('DROP TABLE payment_method');
    }
}
