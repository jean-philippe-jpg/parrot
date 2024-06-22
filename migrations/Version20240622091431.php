<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622091431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_voitures (contact_id INT NOT NULL, voitures_id INT NOT NULL, INDEX IDX_117DAC8CE7A1254A (contact_id), INDEX IDX_117DAC8CCCC4661F (voitures_id), PRIMARY KEY(contact_id, voitures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_voitures ADD CONSTRAINT FK_117DAC8CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_voitures ADD CONSTRAINT FK_117DAC8CCCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_voitures DROP FOREIGN KEY FK_7949F8C7BA9CD190');
        $this->addSql('ALTER TABLE commentaire_voitures DROP FOREIGN KEY FK_7949F8C7CCC4661F');
        $this->addSql('DROP TABLE commentaire_voitures');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_voitures (commentaire_id INT NOT NULL, voitures_id INT NOT NULL, INDEX IDX_7949F8C7BA9CD190 (commentaire_id), INDEX IDX_7949F8C7CCC4661F (voitures_id), PRIMARY KEY(commentaire_id, voitures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire_voitures ADD CONSTRAINT FK_7949F8C7BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_voitures ADD CONSTRAINT FK_7949F8C7CCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_voitures DROP FOREIGN KEY FK_117DAC8CE7A1254A');
        $this->addSql('ALTER TABLE contact_voitures DROP FOREIGN KEY FK_117DAC8CCCC4661F');
        $this->addSql('DROP TABLE contact_voitures');
    }
}
