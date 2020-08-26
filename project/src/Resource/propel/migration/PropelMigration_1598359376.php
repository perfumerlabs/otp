<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1598359376.
 * Generated on 2020-08-25 12:42:56 by otp
 */
class PropelMigration_1598359376
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
            'otp' => '
BEGIN;

DROP TABLE IF EXISTS "limit" CASCADE;

CREATE TABLE "_limit"
(
    "id" serial NOT NULL,
    "channel" INT2 NOT NULL,
    "measure" INT2 NOT NULL,
    "rate" INTEGER NOT NULL,
    "minutes" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

COMMIT;
',
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
            'otp' => '
BEGIN;

DROP TABLE IF EXISTS "_limit" CASCADE;

CREATE TABLE "limit"
(
    "id" serial NOT NULL,
    "channel" INT2 NOT NULL,
    "measure" INT2 NOT NULL,
    "rate" INTEGER NOT NULL,
    "minutes" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

COMMIT;
',
        );
    }

}
