<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314184742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE d_countries (id BIGINT NOT NULL, code2 VARCHAR(2) NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_78FA7690E476B04B ON d_countries (code2)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_78FA76905E237E06 ON d_countries (name)');
        $this->addSql('CREATE INDEX d_countries_code2_name_idx ON d_countries (code2, name)');
        $this->addSql('CREATE TABLE d_countries_tax (id BIGINT NOT NULL, country_id BIGINT NOT NULL, tax_rate NUMERIC(10, 2) NOT NULL, vat_format VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9E5BA6F3F92F3E70 ON d_countries_tax (country_id)');
        $this->addSql('CREATE INDEX d_countries_tax_rate_format_idx ON d_countries_tax (tax_rate, vat_format)');
        $this->addSql('CREATE TABLE d_currencies (id BIGINT NOT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F89961F77153098 ON d_currencies (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F89961F5E237E06 ON d_currencies (name)');
        $this->addSql('CREATE INDEX d_currencies_code_name_idx ON d_currencies (code, name)');
        $this->addSql('CREATE TABLE payment_providers (id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, api_key VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX payment_providers_name_idx ON payment_providers (name)');
        $this->addSql('CREATE TABLE products (id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX products_name_idx ON products (name)');
        $this->addSql('CREATE TABLE products_discount (id BIGINT NOT NULL, product_id BIGINT DEFAULT NULL, coupon_code VARCHAR(255) NOT NULL, coupon_type VARCHAR(255) NOT NULL, value NUMERIC(10, 2) NOT NULL, is_active BOOLEAN DEFAULT false NOT NULL, date_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_end DATE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F4E1A4BD4584665A ON products_discount (product_id)');
        $this->addSql('CREATE INDEX products_discount_idx ON products_discount (coupon_code, value)');
        $this->addSql('COMMENT ON COLUMN products_discount.date_start IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products_discount.date_end IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE products_price (id BIGINT NOT NULL, product_id BIGINT NOT NULL, currency_id BIGINT NOT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, price BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A91DC094584665A ON products_price (product_id)');
        $this->addSql('CREATE INDEX IDX_2A91DC0938248176 ON products_price (currency_id)');
        $this->addSql('CREATE INDEX products_price_idx ON products_price (price)');
        $this->addSql('CREATE TABLE products_transaction (id BIGINT NOT NULL, product_id BIGINT NOT NULL, payment_provider_id BIGINT NOT NULL, amount NUMERIC(10, 0) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_88EA674A4584665A ON products_transaction (product_id)');
        $this->addSql('CREATE INDEX IDX_88EA674AFCDF7870 ON products_transaction (payment_provider_id)');
        $this->addSql('ALTER TABLE d_countries_tax ADD CONSTRAINT FK_9E5BA6F3F92F3E70 FOREIGN KEY (country_id) REFERENCES d_countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_discount ADD CONSTRAINT FK_F4E1A4BD4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_price ADD CONSTRAINT FK_2A91DC094584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_price ADD CONSTRAINT FK_2A91DC0938248176 FOREIGN KEY (currency_id) REFERENCES d_currencies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_transaction ADD CONSTRAINT FK_88EA674A4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_transaction ADD CONSTRAINT FK_88EA674AFCDF7870 FOREIGN KEY (payment_provider_id) REFERENCES payment_providers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE d_countries_tax DROP CONSTRAINT FK_9E5BA6F3F92F3E70');
        $this->addSql('ALTER TABLE products_discount DROP CONSTRAINT FK_F4E1A4BD4584665A');
        $this->addSql('ALTER TABLE products_price DROP CONSTRAINT FK_2A91DC094584665A');
        $this->addSql('ALTER TABLE products_price DROP CONSTRAINT FK_2A91DC0938248176');
        $this->addSql('ALTER TABLE products_transaction DROP CONSTRAINT FK_88EA674A4584665A');
        $this->addSql('ALTER TABLE products_transaction DROP CONSTRAINT FK_88EA674AFCDF7870');
        $this->addSql('DROP TABLE d_countries');
        $this->addSql('DROP TABLE d_countries_tax');
        $this->addSql('DROP TABLE d_currencies');
        $this->addSql('DROP TABLE payment_providers');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE products_discount');
        $this->addSql('DROP TABLE products_price');
        $this->addSql('DROP TABLE products_transaction');
    }
}
