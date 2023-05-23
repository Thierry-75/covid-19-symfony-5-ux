<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508143256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, cases VARCHAR(255) NOT NULL, todat_cases VARCHAR(255) NOT NULL, deaths VARCHAR(255) NOT NULL, today_deaths VARCHAR(255) NOT NULL, recovered VARCHAR(255) NOT NULL, active VARCHAR(255) NOT NULL, critical VARCHAR(255) NOT NULL, cases_per_one_million VARCHAR(255) NOT NULL, deaths_per_one_million VARCHAR(255) NOT NULL, total_test VARCHAR(255) NOT NULL, tests_per_one_million VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP TABLE country');
    }
}
