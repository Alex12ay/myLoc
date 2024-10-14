<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014115837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD point DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE objet CHANGE owner_id owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE nb_point nb_point DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP point');
        $this->addSql('ALTER TABLE objet CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE nb_point nb_point DOUBLE PRECISION DEFAULT NULL');
    }
}
