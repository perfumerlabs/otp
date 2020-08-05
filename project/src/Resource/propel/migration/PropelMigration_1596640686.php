<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1596640686.
 * Generated on 2020-08-05 15:18:06 by otp
 */
class PropelMigration_1596640686
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

CREATE TABLE "otp"
(
    "id" serial NOT NULL,
    "channel" INT2,
    "target" VARCHAR(255),
    "password" VARCHAR(255),
    "expire_at" TIMESTAMP,
    "created_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

CREATE INDEX "otp_i_1d79fd" ON "otp" ("target","password");

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

DROP TABLE IF EXISTS "otp" CASCADE;

COMMIT;
',
        );
    }

}