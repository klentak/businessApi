<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124155741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(255) NOT NULL, nip VARCHAR(10) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(70) NOT NULL, postcode VARCHAR(6) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(130) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(13) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee_company (employee_id INT NOT NULL, company_id INT NOT NULL, PRIMARY KEY(employee_id, company_id))');
        $this->addSql('CREATE INDEX IDX_CFF35F408C03F15C ON employee_company (employee_id)');
        $this->addSql('CREATE INDEX IDX_CFF35F40979B1AD6 ON employee_company (company_id)');
        $this->addSql('ALTER TABLE employee_company ADD CONSTRAINT FK_CFF35F408C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_company ADD CONSTRAINT FK_CFF35F40979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_company DROP CONSTRAINT FK_CFF35F408C03F15C');
        $this->addSql('ALTER TABLE employee_company DROP CONSTRAINT FK_CFF35F40979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_company');
    }
}
