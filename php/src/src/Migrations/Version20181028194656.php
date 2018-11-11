<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028194656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE good (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, durability_days INT NOT NULL, unit VARCHAR(25) NOT NULL, daily_consomption INT NOT NULL, UNIQUE INDEX UNIQ_6C844E925E237E06 (name), INDEX IDX_6C844E9212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, good_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_6BAF787059D8A214 (recipe_id), INDEX IDX_6BAF78701CF98C70 (good_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, score INT NOT NULL, description LONGTEXT NOT NULL, difficulty INT NOT NULL, history LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_DA88B1375E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, main_recipe_id INT DEFAULT NULL, entry_recipe_id INT DEFAULT NULL, desert_recipe_id INT DEFAULT NULL, date DATETIME NOT NULL, consomed TINYINT(1) NOT NULL, INDEX IDX_9EF68E9C796E05B6 (main_recipe_id), INDEX IDX_9EF68E9C21B12C56 (entry_recipe_id), INDEX IDX_9EF68E9C84E4DB8B (desert_recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE withdrawal (id INT AUTO_INCREMENT NOT NULL, good_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, date DATETIME NOT NULL, quantity INT NOT NULL, INDEX IDX_6D2D3B451CF98C70 (good_id), INDEX IDX_6D2D3B45DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry (id INT AUTO_INCREMENT NOT NULL, good_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, date DATETIME NOT NULL, quantity INT NOT NULL, consomed_quantity INT NOT NULL, INDEX IDX_2B219D701CF98C70 (good_id), INDEX IDX_2B219D70DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78701CF98C70 FOREIGN KEY (good_id) REFERENCES good (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C796E05B6 FOREIGN KEY (main_recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C21B12C56 FOREIGN KEY (entry_recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C84E4DB8B FOREIGN KEY (desert_recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE withdrawal ADD CONSTRAINT FK_6D2D3B451CF98C70 FOREIGN KEY (good_id) REFERENCES good (id)');
        $this->addSql('ALTER TABLE withdrawal ADD CONSTRAINT FK_6D2D3B45DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D701CF98C70 FOREIGN KEY (good_id) REFERENCES good (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D70DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE withdrawal DROP FOREIGN KEY FK_6D2D3B45DCD6110');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D70DCD6110');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78701CF98C70');
        $this->addSql('ALTER TABLE withdrawal DROP FOREIGN KEY FK_6D2D3B451CF98C70');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D701CF98C70');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787059D8A214');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C796E05B6');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C21B12C56');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C84E4DB8B');
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E9212469DE2');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE good');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE withdrawal');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE user');
    }
}
