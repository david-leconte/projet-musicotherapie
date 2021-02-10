<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210141630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD user_id INT NOT NULL, ADD cause_id INT NOT NULL, ADD state_id INT NOT NULL, ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84466E2221E FOREIGN KEY (cause_id) REFERENCES cause (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8445D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844C54C8C93 FOREIGN KEY (type_id) REFERENCES appointment_type (id)');
        $this->addSql('CREATE INDEX IDX_FE38F844A76ED395 ON appointment (user_id)');
        $this->addSql('CREATE INDEX IDX_FE38F84466E2221E ON appointment (cause_id)');
        $this->addSql('CREATE INDEX IDX_FE38F8445D83CC1 ON appointment (state_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844C54C8C93 ON appointment (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844A76ED395');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84466E2221E');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8445D83CC1');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844C54C8C93');
        $this->addSql('DROP INDEX IDX_FE38F844A76ED395 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F84466E2221E ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F8445D83CC1 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F844C54C8C93 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP user_id, DROP cause_id, DROP state_id, DROP type_id');
    }
}
