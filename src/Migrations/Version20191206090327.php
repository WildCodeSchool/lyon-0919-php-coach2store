<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206090327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495FB14BA7 ON user (level_id)');
        $this->addSql('ALTER TABLE response ADD advice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB12998205 FOREIGN KEY (advice_id) REFERENCES advice (id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFB12998205 ON response (advice_id)');
        $this->addSql('ALTER TABLE advice ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advice ADD CONSTRAINT FK_64820E8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_64820E8DA76ED395 ON advice (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advice DROP FOREIGN KEY FK_64820E8DA76ED395');
        $this->addSql('DROP INDEX IDX_64820E8DA76ED395 ON advice');
        $this->addSql('ALTER TABLE advice DROP user_id');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB12998205');
        $this->addSql('DROP INDEX IDX_3E7B0BFB12998205 ON response');
        $this->addSql('ALTER TABLE response DROP advice_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495FB14BA7');
        $this->addSql('DROP INDEX UNIQ_8D93D6495FB14BA7 ON user');
        $this->addSql('ALTER TABLE user DROP level_id');
    }
}
