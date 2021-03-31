<?php

namespace Otp\Model\Map;

use Otp\Model\Limit;
use Otp\Model\LimitQuery;
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
 * This class defines the structure of the 'otp_limit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LimitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LimitTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'otp';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'otp_limit';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Otp\\Model\\Limit';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Limit';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'otp_limit.id';

    /**
     * the column name for the channel field
     */
    const COL_CHANNEL = 'otp_limit.channel';

    /**
     * the column name for the measure field
     */
    const COL_MEASURE = 'otp_limit.measure';

    /**
     * the column name for the rate field
     */
    const COL_RATE = 'otp_limit.rate';

    /**
     * the column name for the minutes field
     */
    const COL_MINUTES = 'otp_limit.minutes';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the channel field */
    const COL_CHANNEL_SMS = 'sms';
    const COL_CHANNEL_EMAIL = 'email';

    /** The enumerated values for the measure field */
    const COL_MEASURE_TARGET = 'target';
    const COL_MEASURE_IP = 'ip';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Channel', 'Measure', 'Rate', 'Minutes', ),
        self::TYPE_CAMELNAME     => array('id', 'channel', 'measure', 'rate', 'minutes', ),
        self::TYPE_COLNAME       => array(LimitTableMap::COL_ID, LimitTableMap::COL_CHANNEL, LimitTableMap::COL_MEASURE, LimitTableMap::COL_RATE, LimitTableMap::COL_MINUTES, ),
        self::TYPE_FIELDNAME     => array('id', 'channel', 'measure', 'rate', 'minutes', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Channel' => 1, 'Measure' => 2, 'Rate' => 3, 'Minutes' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'channel' => 1, 'measure' => 2, 'rate' => 3, 'minutes' => 4, ),
        self::TYPE_COLNAME       => array(LimitTableMap::COL_ID => 0, LimitTableMap::COL_CHANNEL => 1, LimitTableMap::COL_MEASURE => 2, LimitTableMap::COL_RATE => 3, LimitTableMap::COL_MINUTES => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'channel' => 1, 'measure' => 2, 'rate' => 3, 'minutes' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Limit.Id' => 'ID',
        'id' => 'ID',
        'limit.id' => 'ID',
        'LimitTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'otp_limit.id' => 'ID',
        'Channel' => 'CHANNEL',
        'Limit.Channel' => 'CHANNEL',
        'channel' => 'CHANNEL',
        'limit.channel' => 'CHANNEL',
        'LimitTableMap::COL_CHANNEL' => 'CHANNEL',
        'COL_CHANNEL' => 'CHANNEL',
        'channel' => 'CHANNEL',
        'otp_limit.channel' => 'CHANNEL',
        'Measure' => 'MEASURE',
        'Limit.Measure' => 'MEASURE',
        'measure' => 'MEASURE',
        'limit.measure' => 'MEASURE',
        'LimitTableMap::COL_MEASURE' => 'MEASURE',
        'COL_MEASURE' => 'MEASURE',
        'measure' => 'MEASURE',
        'otp_limit.measure' => 'MEASURE',
        'Rate' => 'RATE',
        'Limit.Rate' => 'RATE',
        'rate' => 'RATE',
        'limit.rate' => 'RATE',
        'LimitTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'rate' => 'RATE',
        'otp_limit.rate' => 'RATE',
        'Minutes' => 'MINUTES',
        'Limit.Minutes' => 'MINUTES',
        'minutes' => 'MINUTES',
        'limit.minutes' => 'MINUTES',
        'LimitTableMap::COL_MINUTES' => 'MINUTES',
        'COL_MINUTES' => 'MINUTES',
        'minutes' => 'MINUTES',
        'otp_limit.minutes' => 'MINUTES',
    ];

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                LimitTableMap::COL_CHANNEL => array(
                            self::COL_CHANNEL_SMS,
            self::COL_CHANNEL_EMAIL,
        ),
                LimitTableMap::COL_MEASURE => array(
                            self::COL_MEASURE_TARGET,
            self::COL_MEASURE_IP,
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
        $this->setName('otp_limit');
        $this->setPhpName('Limit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Otp\\Model\\Limit');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('otp_limit_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('channel', 'Channel', 'ENUM', true, null, null);
        $this->getColumn('channel')->setValueSet(array (
  0 => 'sms',
  1 => 'email',
));
        $this->addColumn('measure', 'Measure', 'ENUM', true, null, null);
        $this->getColumn('measure')->setValueSet(array (
  0 => 'target',
  1 => 'ip',
));
        $this->addColumn('rate', 'Rate', 'INTEGER', true, null, null);
        $this->addColumn('minutes', 'Minutes', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

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
        return $withPrefix ? LimitTableMap::CLASS_DEFAULT : LimitTableMap::OM_CLASS;
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
     * @return array           (Limit object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LimitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LimitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LimitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LimitTableMap::OM_CLASS;
            /** @var Limit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LimitTableMap::addInstanceToPool($obj, $key);
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
            $key = LimitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LimitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Limit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LimitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LimitTableMap::COL_ID);
            $criteria->addSelectColumn(LimitTableMap::COL_CHANNEL);
            $criteria->addSelectColumn(LimitTableMap::COL_MEASURE);
            $criteria->addSelectColumn(LimitTableMap::COL_RATE);
            $criteria->addSelectColumn(LimitTableMap::COL_MINUTES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.channel');
            $criteria->addSelectColumn($alias . '.measure');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.minutes');
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
            $criteria->removeSelectColumn(LimitTableMap::COL_ID);
            $criteria->removeSelectColumn(LimitTableMap::COL_CHANNEL);
            $criteria->removeSelectColumn(LimitTableMap::COL_MEASURE);
            $criteria->removeSelectColumn(LimitTableMap::COL_RATE);
            $criteria->removeSelectColumn(LimitTableMap::COL_MINUTES);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.channel');
            $criteria->removeSelectColumn($alias . '.measure');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.minutes');
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
        return Propel::getServiceContainer()->getDatabaseMap(LimitTableMap::DATABASE_NAME)->getTable(LimitTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LimitTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LimitTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LimitTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Limit or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Limit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LimitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Otp\Model\Limit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LimitTableMap::DATABASE_NAME);
            $criteria->add(LimitTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LimitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LimitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LimitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the otp_limit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LimitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Limit or Criteria object.
     *
     * @param mixed               $criteria Criteria or Limit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LimitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Limit object
        }

        if ($criteria->containsKey(LimitTableMap::COL_ID) && $criteria->keyContainsValue(LimitTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LimitTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LimitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LimitTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LimitTableMap::buildTableMap();
