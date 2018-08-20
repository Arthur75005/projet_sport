<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180820081102 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE date_de_naissance date_de_naissance DATE DEFAULT NULL, CHANGE sexe sexe VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge CHANGE event_id event_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE date_de_naissance date_de_naissance DATE NOT NULL, CHANGE sexe sexe VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
