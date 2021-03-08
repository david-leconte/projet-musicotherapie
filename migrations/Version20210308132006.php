<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308132006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84466E2221E');
        $this->addSql('CREATE TABLE cause_type (id INT AUTO_INCREMENT NOT NULL, name_type VARCHAR(255) NOT NULL, description VARCHAR(512) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE cause');
        $this->addSql('DROP INDEX IDX_FE38F84466E2221E ON appointment');
        $this->addSql('ALTER TABLE appointment ADD complete_cause VARCHAR(500) NOT NULL, CHANGE cause_id cause_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8445F636633 FOREIGN KEY (cause_type_id) REFERENCES cause_type (id)');
        $this->addSql('CREATE INDEX IDX_FE38F8445F636633 ON appointment (cause_type_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8445F636633');
        $this->addSql('CREATE TABLE cause (id INT AUTO_INCREMENT NOT NULL, name_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(512) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE cause_type');
        $this->addSql('DROP INDEX IDX_FE38F8445F636633 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP complete_cause, CHANGE cause_type_id cause_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84466E2221E FOREIGN KEY (cause_id) REFERENCES cause (id)');
        $this->addSql('CREATE INDEX IDX_FE38F84466E2221E ON appointment (cause_id)');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
