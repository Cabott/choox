<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170325151705 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logo ADD original_logo VARCHAR(100) NOT NULL, ADD altered_logo VARCHAR(100) NOT NULL, DROP original_logo_file, DROP altered_logo_file, CHANGE team_name_alternative team_name_alternative VARCHAR(100) DEFAULT NULL, CHANGE team_name_alternative2 team_name_alternative2 VARCHAR(100) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logo ADD original_logo_file VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD altered_logo_file VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, DROP original_logo, DROP altered_logo, CHANGE team_name_alternative team_name_alternative VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE team_name_alternative2 team_name_alternative2 VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
