<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512150251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD name_id INT NOT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96671179CD6 FOREIGN KEY (name_id) REFERENCES continent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5373C96671179CD6 ON country (name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE country DROP CONSTRAINT FK_5373C96671179CD6');
        $this->addSql('DROP INDEX IDX_5373C96671179CD6');
        $this->addSql('ALTER TABLE country DROP name_id');
    }
}
