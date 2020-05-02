<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502184807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT DEFAULT NULL, fk_tricks_id INT DEFAULT NULL, comment VARCHAR(1024) NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_5F9E962A5741EEB9 (fk_user_id), INDEX IDX_5F9E962A5A4CE6C4 (fk_tricks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keys_encryption (id INT AUTO_INCREMENT NOT NULL, user_fk_id INT DEFAULT NULL, key_user LONGBLOB NOT NULL, iv_user LONGBLOB NOT NULL, UNIQUE INDEX UNIQ_7EA3BEF947B5E288 (user_fk_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pic (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT DEFAULT NULL, fk_tricks_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, profile TINYINT(1) NOT NULL, INDEX IDX_CB34514E5741EEB9 (fk_user_id), INDEX IDX_CB34514E5A4CE6C4 (fk_tricks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks (id INT AUTO_INCREMENT NOT NULL, fk_tricks_group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(512) NOT NULL, create_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E1D902C17ED56D5 (fk_tricks_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5A4CE6C4 FOREIGN KEY (fk_tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE keys_encryption ADD CONSTRAINT FK_7EA3BEF947B5E288 FOREIGN KEY (user_fk_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pic ADD CONSTRAINT FK_CB34514E5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pic ADD CONSTRAINT FK_CB34514E5A4CE6C4 FOREIGN KEY (fk_tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C17ED56D5 FOREIGN KEY (fk_tricks_group_id) REFERENCES tricks_group (id)');
        $this->addSql('ALTER TABLE user DROP name, DROP validation_code');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA6432A76ED395');
        $this->addSql('DROP INDEX IDX_29AA6432A76ED395 ON videos');
        $this->addSql('ALTER TABLE videos ADD fk_tricks_id INT DEFAULT NULL, CHANGE user_id user_fk_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA643247B5E288 FOREIGN KEY (user_fk_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA64325A4CE6C4 FOREIGN KEY (fk_tricks_id) REFERENCES tricks (id)');
        $this->addSql('CREATE INDEX IDX_29AA643247B5E288 ON videos (user_fk_id)');
        $this->addSql('CREATE INDEX IDX_29AA64325A4CE6C4 ON videos (fk_tricks_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A5A4CE6C4');
        $this->addSql('ALTER TABLE pic DROP FOREIGN KEY FK_CB34514E5A4CE6C4');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA64325A4CE6C4');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C17ED56D5');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE keys_encryption');
        $this->addSql('DROP TABLE pic');
        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE tricks_group');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD validation_code INT NOT NULL');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA643247B5E288');
        $this->addSql('DROP INDEX IDX_29AA643247B5E288 ON videos');
        $this->addSql('DROP INDEX IDX_29AA64325A4CE6C4 ON videos');
        $this->addSql('ALTER TABLE videos ADD user_id INT DEFAULT NULL, DROP user_fk_id, DROP fk_tricks_id');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA6432A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_29AA6432A76ED395 ON videos (user_id)');
    }
}
