<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318081940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_discount_product (product_discount_id BIGINT NOT NULL, product_id BIGINT NOT NULL, PRIMARY KEY(product_discount_id, product_id))');
        $this->addSql('CREATE INDEX IDX_EBCE0D40E053FF00 ON product_discount_product (product_discount_id)');
        $this->addSql('CREATE INDEX IDX_EBCE0D404584665A ON product_discount_product (product_id)');
        $this->addSql('ALTER TABLE product_discount_product ADD CONSTRAINT FK_EBCE0D40E053FF00 FOREIGN KEY (product_discount_id) REFERENCES products_discount (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_discount_product ADD CONSTRAINT FK_EBCE0D404584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE d_countries_tax ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE d_countries_tax ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN d_countries_tax.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN d_countries_tax.archived_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE products ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products ALTER deleted_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products.archived_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE products_discount DROP CONSTRAINT fk_f4e1a4bd4584665a');
        $this->addSql('DROP INDEX idx_f4e1a4bd4584665a');
        $this->addSql('ALTER TABLE products_discount DROP product_id');
        $this->addSql('ALTER TABLE products_discount ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_discount ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_discount ALTER deleted_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_discount.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products_discount.archived_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products_discount.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX products_discount_coupon_code_unique_idx ON products_discount (coupon_code)');
        $this->addSql('ALTER TABLE products_price ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_price.archived_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE products_transaction ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_transaction ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_transaction.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN products_transaction.archived_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_discount_product DROP CONSTRAINT FK_EBCE0D40E053FF00');
        $this->addSql('ALTER TABLE product_discount_product DROP CONSTRAINT FK_EBCE0D404584665A');
        $this->addSql('DROP TABLE product_discount_product');
        $this->addSql('DROP INDEX products_discount_coupon_code_unique_idx');
        $this->addSql('ALTER TABLE products_discount ADD product_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE products_discount ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_discount ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_discount ALTER deleted_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_discount.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN products_discount.archived_at IS NULL');
        $this->addSql('COMMENT ON COLUMN products_discount.deleted_at IS NULL');
        $this->addSql('ALTER TABLE products_discount ADD CONSTRAINT fk_f4e1a4bd4584665a FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f4e1a4bd4584665a ON products_discount (product_id)');
        $this->addSql('ALTER TABLE products_price ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_price.archived_at IS NULL');
        $this->addSql('ALTER TABLE d_countries_tax ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE d_countries_tax ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN d_countries_tax.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN d_countries_tax.archived_at IS NULL');
        $this->addSql('ALTER TABLE products ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products ALTER deleted_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN products.archived_at IS NULL');
        $this->addSql('COMMENT ON COLUMN products.deleted_at IS NULL');
        $this->addSql('ALTER TABLE products_transaction ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE products_transaction ALTER archived_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN products_transaction.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN products_transaction.archived_at IS NULL');
    }
}
