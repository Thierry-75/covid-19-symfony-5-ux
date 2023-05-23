<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512161546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP CONSTRAINT fk_5373c96671179cd6');
        $this->addSql('DROP INDEX idx_5373c96671179cd6');
        $this->addSql('ALTER TABLE country DROP name_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE country ADD name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT fk_5373c96671179cd6 FOREIGN KEY (name_id) REFERENCES continent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5373c96671179cd6 ON country (name_id)');
    }
}
