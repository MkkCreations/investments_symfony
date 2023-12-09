<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207220440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD balance_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AE91A3DD ON user (balance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AE91A3DD');
        $this->addSql('DROP INDEX UNIQ_8D93D649AE91A3DD ON user');
        $this->addSql('ALTER TABLE user DROP balance_id');
    }
}
