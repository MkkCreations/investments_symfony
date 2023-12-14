<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211081323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE log_balance (id INT AUTO_INCREMENT NOT NULL, balance_id INT NOT NULL, added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, INDEX IDX_94392769AE91A3DD (balance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE log_balance ADD CONSTRAINT FK_94392769AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE log_balance DROP FOREIGN KEY FK_94392769AE91A3DD');
        $this->addSql('DROP TABLE log_balance');
    }
}
