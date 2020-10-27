<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201027115825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE additional_equipment ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE additional_equipment ADD CONSTRAINT FK_BC3273DE545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_BC3273DE545317D1 ON additional_equipment (vehicle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE additional_equipment DROP FOREIGN KEY FK_BC3273DE545317D1');
        $this->addSql('DROP INDEX IDX_BC3273DE545317D1 ON additional_equipment');
        $this->addSql('ALTER TABLE additional_equipment DROP vehicle_id');
    }
}
