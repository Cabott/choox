<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170415165735 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logo ADD team_name_alternatives TEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', DROP team_name_alternative, DROP team_name_alternative2, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE logo ADD CONSTRAINT FK_E48E9A138D93D649 FOREIGN KEY (user) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E48E9A138D93D649 ON logo (user)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A138D93D649');
        $this->addSql('DROP INDEX IDX_E48E9A138D93D649 ON logo');
        $this->addSql('ALTER TABLE logo ADD team_name_alternative VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD team_name_alternative2 VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP team_name_alternatives, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
