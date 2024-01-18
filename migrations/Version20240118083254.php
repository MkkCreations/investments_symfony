<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118083254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset (id INT AUTO_INCREMENT NOT NULL, portfolio_id INT DEFAULT NULL, name VARCHAR(128) NOT NULL, bought_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount DOUBLE PRECISION NOT NULL, bought_price DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, sold_price DOUBLE PRECISION DEFAULT NULL, sold_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2AF5A5CB96B5643 (portfolio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE balance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, currency VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_ACF41FFEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log_balance (id INT AUTO_INCREMENT NOT NULL, balance_id INT NOT NULL, added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_94392769AE91A3DD (balance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(64) NOT NULL, INDEX IDX_A9ED1062A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, balance_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', connected_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', first_name VARCHAR(128) NOT NULL, last_name VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649AE91A3DD (balance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CB96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE log_balance ADD CONSTRAINT FK_94392769AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5CB96B5643');
        $this->addSql('ALTER TABLE balance DROP FOREIGN KEY FK_ACF41FFEA76ED395');
        $this->addSql('ALTER TABLE log_balance DROP FOREIGN KEY FK_94392769AE91A3DD');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AE91A3DD');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE balance');
        $this->addSql('DROP TABLE log_balance');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
