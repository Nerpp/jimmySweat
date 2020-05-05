<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505130836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tricks ADD fk_tricks_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C17ED56D5 FOREIGN KEY (fk_tricks_group_id) REFERENCES tricks_group (id)');
        $this->addSql('CREATE INDEX IDX_E1D902C17ED56D5 ON tricks (fk_tricks_group_id)');
        $this->addSql('ALTER TABLE tricks_group DROP FOREIGN KEY FK_B4F07AAC5A4CE6C4');
        $this->addSql('DROP INDEX IDX_B4F07AAC5A4CE6C4 ON tricks_group');
        $this->addSql('ALTER TABLE tricks_group DROP fk_tricks_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C17ED56D5');
        $this->addSql('DROP INDEX IDX_E1D902C17ED56D5 ON tricks');
        $this->addSql('ALTER TABLE tricks DROP fk_tricks_group_id');
        $this->addSql('ALTER TABLE tricks_group ADD fk_tricks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tricks_group ADD CONSTRAINT FK_B4F07AAC5A4CE6C4 FOREIGN KEY (fk_tricks_id) REFERENCES tricks (id)');
        $this->addSql('CREATE INDEX IDX_B4F07AAC5A4CE6C4 ON tricks_group (fk_tricks_id)');
    }
}
