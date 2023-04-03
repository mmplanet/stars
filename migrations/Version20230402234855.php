<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402234855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, appearance VARCHAR(255) DEFAULT NULL, atomic_mass DOUBLE PRECISION DEFAULT NULL, boil DOUBLE PRECISION DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, density DOUBLE PRECISION DEFAULT NULL, melt DOUBLE PRECISION DEFAULT NULL, number INT DEFAULT NULL, period INT DEFAULT NULL, `group` INT DEFAULT NULL, phase VARCHAR(255) DEFAULT NULL, symbol VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galaxy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE star (id INT AUTO_INCREMENT NOT NULL, galaxy_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, radius INT DEFAULT NULL, temperature INT DEFAULT NULL, rotation_frequency INT DEFAULT NULL, INDEX IDX_C9DB5A14B61FAB2 (galaxy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE star_elements (star_id INT NOT NULL, element_id INT NOT NULL, INDEX IDX_C063A68D2C3B70D7 (star_id), INDEX IDX_C063A68D1F1F2A24 (element_id), PRIMARY KEY(star_id, element_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE star ADD CONSTRAINT FK_C9DB5A14B61FAB2 FOREIGN KEY (galaxy_id) REFERENCES galaxy (id)');
        $this->addSql('ALTER TABLE star_elements ADD CONSTRAINT FK_C063A68D2C3B70D7 FOREIGN KEY (star_id) REFERENCES star (id)');
        $this->addSql('ALTER TABLE star_elements ADD CONSTRAINT FK_C063A68D1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE star DROP FOREIGN KEY FK_C9DB5A14B61FAB2');
        $this->addSql('ALTER TABLE star_elements DROP FOREIGN KEY FK_C063A68D2C3B70D7');
        $this->addSql('ALTER TABLE star_elements DROP FOREIGN KEY FK_C063A68D1F1F2A24');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE galaxy');
        $this->addSql('DROP TABLE star');
        $this->addSql('DROP TABLE star_elements');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
