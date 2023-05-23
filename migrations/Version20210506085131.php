<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506085131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE departement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pays_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE departement (id INT NOT NULL, date DATE NOT NULL, nom VARCHAR(255) NOT NULL, hospitalisation VARCHAR(255) NOT NULL, reanimation VARCHAR(255) NOT NULL, nouvelles_hospitalisations VARCHAR(255) NOT NULL, nouvelles_reanimations VARCHAR(255) NOT NULL, deces VARCHAR(255) NOT NULL, gueris VARCHAR(255) NOT NULL, source_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pays (id INT NOT NULL, date DATE NOT NULL, nom VARCHAR(255) NOT NULL, hospitalisation VARCHAR(255) NOT NULL, reanimation VARCHAR(255) NOT NULL, nouvelles_hospitalisations VARCHAR(255) NOT NULL, nouvelles_reanimations VARCHAR(255) NOT NULL, deces VARCHAR(255) NOT NULL, gueris VARCHAR(255) NOT NULL, source_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, date DATE NOT NULL, nom VARCHAR(255) NOT NULL, hospitalisation VARCHAR(255) NOT NULL, reanimation VARCHAR(255) NOT NULL, nouvelles_hospitalisations VARCHAR(255) NOT NULL, nouvelles_reanimations VARCHAR(255) NOT NULL, deces VARCHAR(255) NOT NULL, gueris VARCHAR(255) NOT NULL, source_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE departement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pays_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE "user"');
    }
}
