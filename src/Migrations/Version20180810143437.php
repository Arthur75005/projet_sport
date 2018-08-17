<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180810143437 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, INDEX IDX_D709895171F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_team (challenge_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_CD4FA19998A21AC6 (challenge_id), INDEX IDX_CD4FA199296CD8AE (team_id), PRIMARY KEY(challenge_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D709895171F7E88B FOREIGN KEY (event_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE challenge_team ADD CONSTRAINT FK_CD4FA19998A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE challenge_team ADD CONSTRAINT FK_CD4FA199296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge_team DROP FOREIGN KEY FK_CD4FA19998A21AC6');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE challenge_team');
    }
}
