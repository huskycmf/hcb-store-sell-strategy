<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Initial migration
 */
class VersionHcbStoreSellStrategy20140617163907 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `store_sell_strategy` (
                      `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                      `name` VARCHAR(45) NULL,
                      PRIMARY KEY (`id`)) ENGINE = InnoDB');

        $this->addSql('CREATE TABLE IF NOT EXISTS `store_sell_strategy_product` (
                          `store_sell_strategy_id` INT UNSIGNED NOT NULL,
                          `store_sell_product_id` INT UNSIGNED NOT NULL,
                          `store_product_id` INT UNSIGNED NOT NULL,
                          INDEX `fk_store_product_sell_strategy_product_store_product1_idx` (`store_sell_product_id` ASC),
                          PRIMARY KEY (`store_sell_strategy_id`, `store_sell_product_id`, `store_product_id`),
                          INDEX `fk_store_sell_strategy_product_store_product1_idx` (`store_product_id` ASC),
                          CONSTRAINT `fk_store_product_sell_strategy_has_products_store_product_sel1`
                            FOREIGN KEY (`store_sell_strategy_id`)
                            REFERENCES `store_sell_strategy` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE,
                          CONSTRAINT `fk_store_product_sell_strategy_product_store_product1`
                            FOREIGN KEY (`store_sell_product_id`)
                            REFERENCES `store_product` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE,
                          CONSTRAINT `fk_store_sell_strategy_product_store_product1`
                            FOREIGN KEY (`store_product_id`)
                            REFERENCES `store_product` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE)
                        ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('store_sell_strategy_product');
        $schema->dropTable('store_sell_strategy');
    }
}
