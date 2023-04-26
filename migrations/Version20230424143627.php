<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424143627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_ergonomics (room_id INT NOT NULL, ergonomics_id INT NOT NULL, INDEX IDX_B939E08654177093 (room_id), INDEX IDX_B939E086EB3269B9 (ergonomics_id), PRIMARY KEY(room_id, ergonomics_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_ergonomics ADD CONSTRAINT FK_B939E08654177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_ergonomics ADD CONSTRAINT FK_B939E086EB3269B9 FOREIGN KEY (ergonomics_id) REFERENCES ergonomics (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_ergonomics DROP FOREIGN KEY FK_B939E08654177093');
        $this->addSql('ALTER TABLE room_ergonomics DROP FOREIGN KEY FK_B939E086EB3269B9');
        $this->addSql('DROP TABLE room_ergonomics');
    }
}
