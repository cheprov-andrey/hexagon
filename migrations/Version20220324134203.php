<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324134203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, about_action VARCHAR(255) NOT NULL, type_discount INT NOT NULL, weight_discount INT NOT NULL, date_start INT NOT NULL, date_end INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_product (action_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_9E88C4C9D32F035 (action_id), INDEX IDX_9E88C4C4584665A (product_id), PRIMARY KEY(action_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_rules (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, rule VARCHAR(255) NOT NULL, INDEX IDX_6E5455809D32F035 (action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, weight INT NOT NULL, price INT NOT NULL, authors INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action_product ADD CONSTRAINT FK_9E88C4C9D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_product ADD CONSTRAINT FK_9E88C4C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_rules ADD CONSTRAINT FK_6E5455809D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_product DROP FOREIGN KEY FK_9E88C4C9D32F035');
        $this->addSql('ALTER TABLE action_rules DROP FOREIGN KEY FK_6E5455809D32F035');
        $this->addSql('ALTER TABLE action_product DROP FOREIGN KEY FK_9E88C4C4584665A');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE action_product');
        $this->addSql('DROP TABLE action_rules');
        $this->addSql('DROP TABLE product');
    }
}
