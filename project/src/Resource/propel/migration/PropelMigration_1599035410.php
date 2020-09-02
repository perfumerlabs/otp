<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1599035410.
 * Generated on 2020-09-02 08:30:10 by otp
 */
class PropelMigration_1599035410
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

CREATE TABLE "otp_password"
(
    "id" serial NOT NULL,
    "channel" INT2,
    "target" VARCHAR(255),
    "password" VARCHAR(255),
    "ip" VARCHAR(255),
    "expire_at" TIMESTAMP,
    "created_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

CREATE INDEX "otp_password_i_1d79fd" ON "otp_password" ("target","password");

CREATE INDEX "otp_password_i_fbfe9a" ON "otp_password" ("expire_at");

CREATE INDEX "otp_password_i_d404ac" ON "otp_password" ("created_at");

CREATE INDEX "otp_password_i_1d579d" ON "otp_password" ("ip");

CREATE TABLE "otp_limit"
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

DROP TABLE IF EXISTS "otp_password" CASCADE;

DROP TABLE IF EXISTS "otp_limit" CASCADE;

COMMIT;
',
        );
    }

}
