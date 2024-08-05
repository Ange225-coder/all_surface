<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240804120256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F4B7B1D444F97DD ON subscription_in_process');
        $this->addSql('DROP INDEX UNIQ_F4B7B1DE7927C74 ON subscription_in_process');
        $this->addSql('ALTER TABLE subscription_in_process DROP password, DROP roles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription_in_process ADD password VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4B7B1D444F97DD ON subscription_in_process (phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4B7B1DE7927C74 ON subscription_in_process (email)');
    }
}
