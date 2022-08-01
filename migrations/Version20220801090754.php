<?php

declare(strict_types=1);

namespace app\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801090754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cities (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contest_requests (id BIGINT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, city_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', sticker_code VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sticker_codes (id BIGINT AUTO_INCREMENT NOT NULL, code BIGINT NOT NULL, UNIQUE INDEX UNIQ_DDD2075B77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE contest_requests');
        $this->addSql('DROP TABLE sticker_codes');
    }
}
