<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211213131420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("insert into Product (id, name, price) values (1, 'Soup - Knorr, Classic Can. Chili', 89);");
       $this->addSql("insert into Product (id, name, price) values (2, 'Wood Chips - Regular', 63);");
        $this->addSql("insert into Product (id, name, price) values (3, 'Swordfish Loin Portions', 46);");
        $this->addSql("insert into Product (id, name, price) values (4, 'Oil - Sesame', 86);");
        $this->addSql("insert into Product (id, name, price) values (5, 'Mushroom - Crimini', 47);");
        $this->addSql("insert into Product (id, name, price) values (6, 'Water - Spring 1.5lit', 49);");
        $this->addSql("insert into Product (id, name, price) values (7, 'Beef - Ground, Extra Lean, Fresh', 50);");
        $this->addSql("insert into Product (id, name, price) values (8, 'Sole - Fillet', 31);");
        $this->addSql("insert into Product (id, name, price) values (9, 'Squash - Acorn', 5);");
        $this->addSql("insert into Product (id, name, price) values (10, 'Wine - Magnotta - Red, Baco', 60);");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
    }
}
