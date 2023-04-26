<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424143727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_material (room_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_DC58B55154177093 (room_id), INDEX IDX_DC58B551E308AC6F (material_id), PRIMARY KEY(room_id, material_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_material ADD CONSTRAINT FK_DC58B55154177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_material ADD CONSTRAINT FK_DC58B551E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_material DROP FOREIGN KEY FK_DC58B55154177093');
        $this->addSql('ALTER TABLE room_material DROP FOREIGN KEY FK_DC58B551E308AC6F');
        $this->addSql('DROP TABLE room_material');
    }
}
