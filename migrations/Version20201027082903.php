<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201027082903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE additional_equipment (id INT AUTO_INCREMENT NOT NULL, abs TINYINT(1) NOT NULL, esp TINYINT(1) NOT NULL, remote_locking TINYINT(1) NOT NULL, isofix TINYINT(1) NOT NULL, engine_immobilizer TINYINT(1) NOT NULL, start_stop TINYINT(1) NOT NULL, hac TINYINT(1) NOT NULL, rain_sensors TINYINT(1) NOT NULL, light_sensors TINYINT(1) NOT NULL, alarm TINYINT(1) NOT NULL, multifunctional_steering_wheel TINYINT(1) NOT NULL, park_sensors TINYINT(1) NOT NULL, alloy_wheels TINYINT(1) NOT NULL, clima TINYINT(1) NOT NULL, third_stop_light TINYINT(1) NOT NULL, cruise_control TINYINT(1) NOT NULL, electric_window_lifters_front TINYINT(1) NOT NULL, electric_window_lifters_rear TINYINT(1) NOT NULL, electric_folding_mirrors TINYINT(1) NOT NULL, tinted_glass TINYINT(1) NOT NULL, fog_lights TINYINT(1) NOT NULL, roof_window TINYINT(1) NOT NULL, touch_radio TINYINT(1) NOT NULL, metallic_color TINYINT(1) NOT NULL, child_lock TINYINT(1) NOT NULL, ledlights_front TINYINT(1) NOT NULL, ledlights_rear TINYINT(1) NOT NULL, ledinterrior TINYINT(1) NOT NULL, leather_seats TINYINT(1) NOT NULL, sport_seats TINYINT(1) NOT NULL, rear_parking_camera TINYINT(1) NOT NULL, seat_heating TINYINT(1) NOT NULL, handsfree TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE additional_equipment');
    }
}
