<?php

namespace Otp\Model\Map;

use Otp\Model\Password;
use Otp\Model\PasswordQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'otp_password' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PasswordTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PasswordTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'otp';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'otp_password';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Otp\\Model\\Password';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Password';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'otp_password.id';

    /**
     * the column name for the channel field
     */
    const COL_CHANNEL = 'otp_password.channel';

    /**
     * the column name for the target field
     */
    const COL_TARGET = 'otp_password.target';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'otp_password.password';

    /**
     * the column name for the ip field
     */
    const COL_IP = 'otp_password.ip';

    /**
     * the column name for the expire_at field
     */
    const COL_EXPIRE_AT = 'otp_password.expire_at';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'otp_password.created_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the channel field */
    const COL_CHANNEL_SMS = 'sms';
    const COL_CHANNEL_EMAIL = 'email';
    const COL_CHANNEL_CALL = 'call';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Channel', 'Target', 'Password', 'Ip', 'ExpireAt', 'CreatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'channel', 'target', 'password', 'ip', 'expireAt', 'createdAt', ),
        self::TYPE_COLNAME       => array(PasswordTableMap::COL_ID, PasswordTableMap::COL_CHANNEL, PasswordTableMap::COL_TARGET, PasswordTableMap::COL_PASSWORD, PasswordTableMap::COL_IP, PasswordTableMap::COL_EXPIRE_AT, PasswordTableMap::COL_CREATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'channel', 'target', 'password', 'ip', 'expire_at', 'created_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Channel' => 1, 'Target' => 2, 'Password' => 3, 'Ip' => 4, 'ExpireAt' => 5, 'CreatedAt' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'channel' => 1, 'target' => 2, 'password' => 3, 'ip' => 4, 'expireAt' => 5, 'createdAt' => 6, ),
        self::TYPE_COLNAME       => array(PasswordTableMap::COL_ID => 0, PasswordTableMap::COL_CHANNEL => 1, PasswordTableMap::COL_TARGET => 2, PasswordTableMap::COL_PASSWORD => 3, PasswordTableMap::COL_IP => 4, PasswordTableMap::COL_EXPIRE_AT => 5, PasswordTableMap::COL_CREATED_AT => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'channel' => 1, 'target' => 2, 'password' => 3, 'ip' => 4, 'expire_at' => 5, 'created_at' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Password.Id' => 'ID',
        'id' => 'ID',
        'password.id' => 'ID',
        'PasswordTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'otp_password.id' => 'ID',
        'Channel' => 'CHANNEL',
        'Password.Channel' => 'CHANNEL',
        'channel' => 'CHANNEL',
        'password.channel' => 'CHANNEL',
        'PasswordTableMap::COL_CHANNEL' => 'CHANNEL',
        'COL_CHANNEL' => 'CHANNEL',
        'channel' => 'CHANNEL',
        'otp_password.channel' => 'CHANNEL',
        'Target' => 'TARGET',
        'Password.Target' => 'TARGET',
        'target' => 'TARGET',
        'password.target' => 'TARGET',
        'PasswordTableMap::COL_TARGET' => 'TARGET',
        'COL_TARGET' => 'TARGET',
        'target' => 'TARGET',
        'otp_password.target' => 'TARGET',
        'Password' => 'PASSWORD',
        'Password.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'password.password' => 'PASSWORD',
        'PasswordTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'password' => 'PASSWORD',
        'otp_password.password' => 'PASSWORD',
        'Ip' => 'IP',
        'Password.Ip' => 'IP',
        'ip' => 'IP',
        'password.ip' => 'IP',
        'PasswordTableMap::COL_IP' => 'IP',
        'COL_IP' => 'IP',
        'ip' => 'IP',
        'otp_password.ip' => 'IP',
        'ExpireAt' => 'EXPIRE_AT',
        'Password.ExpireAt' => 'EXPIRE_AT',
        'expireAt' => 'EXPIRE_AT',
        'password.expireAt' => 'EXPIRE_AT',
        'PasswordTableMap::COL_EXPIRE_AT' => 'EXPIRE_AT',
        'COL_EXPIRE_AT' => 'EXPIRE_AT',
        'expire_at' => 'EXPIRE_AT',
        'otp_password.expire_at' => 'EXPIRE_AT',
        'CreatedAt' => 'CREATED_AT',
        'Password.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'password.createdAt' => 'CREATED_AT',
        'PasswordTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'otp_password.created_at' => 'CREATED_AT',
    ];

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                PasswordTableMap::COL_CHANNEL => array(
                            self::COL_CHANNEL_SMS,
            self::COL_CHANNEL_EMAIL,
            self::COL_CHANNEL_CALL,
        ),
    );

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets()
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('otp_password');
        $this->setPhpName('Password');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Otp\\Model\\Password');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('otp_password_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('channel', 'Channel', 'ENUM', false, null, null);
        $this->getColumn('channel')->setValueSet(array (
  0 => 'sms',
  1 => 'email',
  2 => 'call',
));
        $this->addColumn('target', 'Target', 'VARCHAR', false, 255, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 255, null);
        $this->addColumn('ip', 'Ip', 'VARCHAR', false, 255, null);
        $this->addColumn('expire_at', 'ExpireAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'true', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PasswordTableMap::CLASS_DEFAULT : PasswordTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Password object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PasswordTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PasswordTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PasswordTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PasswordTableMap::OM_CLASS;
            /** @var Password $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PasswordTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PasswordTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PasswordTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Password $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PasswordTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PasswordTableMap::COL_ID);
            $criteria->addSelectColumn(PasswordTableMap::COL_CHANNEL);
            $criteria->addSelectColumn(PasswordTableMap::COL_TARGET);
            $criteria->addSelectColumn(PasswordTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(PasswordTableMap::COL_IP);
            $criteria->addSelectColumn(PasswordTableMap::COL_EXPIRE_AT);
            $criteria->addSelectColumn(PasswordTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.channel');
            $criteria->addSelectColumn($alias . '.target');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.ip');
            $criteria->addSelectColumn($alias . '.expire_at');
            $criteria->addSelectColumn($alias . '.created_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PasswordTableMap::COL_ID);
            $criteria->removeSelectColumn(PasswordTableMap::COL_CHANNEL);
            $criteria->removeSelectColumn(PasswordTableMap::COL_TARGET);
            $criteria->removeSelectColumn(PasswordTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(PasswordTableMap::COL_IP);
            $criteria->removeSelectColumn(PasswordTableMap::COL_EXPIRE_AT);
            $criteria->removeSelectColumn(PasswordTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.channel');
            $criteria->removeSelectColumn($alias . '.target');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.ip');
            $criteria->removeSelectColumn($alias . '.expire_at');
            $criteria->removeSelectColumn($alias . '.created_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PasswordTableMap::DATABASE_NAME)->getTable(PasswordTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PasswordTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PasswordTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PasswordTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Password or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Password object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PasswordTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Otp\Model\Password) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PasswordTableMap::DATABASE_NAME);
            $criteria->add(PasswordTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PasswordQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PasswordTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PasswordTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the otp_password table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PasswordQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Password or Criteria object.
     *
     * @param mixed               $criteria Criteria or Password object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PasswordTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Password object
        }

        if ($criteria->containsKey(PasswordTableMap::COL_ID) && $criteria->keyContainsValue(PasswordTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PasswordTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PasswordQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PasswordTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PasswordTableMap::buildTableMap();
