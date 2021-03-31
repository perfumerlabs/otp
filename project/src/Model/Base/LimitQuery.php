<?php

namespace Otp\Model\Base;

use \Exception;
use \PDO;
use Otp\Model\Limit as ChildLimit;
use Otp\Model\LimitQuery as ChildLimitQuery;
use Otp\Model\Map\LimitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'otp_limit' table.
 *
 *
 *
 * @method     ChildLimitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLimitQuery orderByChannel($order = Criteria::ASC) Order by the channel column
 * @method     ChildLimitQuery orderByMeasure($order = Criteria::ASC) Order by the measure column
 * @method     ChildLimitQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildLimitQuery orderByMinutes($order = Criteria::ASC) Order by the minutes column
 *
 * @method     ChildLimitQuery groupById() Group by the id column
 * @method     ChildLimitQuery groupByChannel() Group by the channel column
 * @method     ChildLimitQuery groupByMeasure() Group by the measure column
 * @method     ChildLimitQuery groupByRate() Group by the rate column
 * @method     ChildLimitQuery groupByMinutes() Group by the minutes column
 *
 * @method     ChildLimitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLimitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLimitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLimitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLimitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLimitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLimit|null findOne(ConnectionInterface $con = null) Return the first ChildLimit matching the query
 * @method     ChildLimit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLimit matching the query, or a new ChildLimit object populated from the query conditions when no match is found
 *
 * @method     ChildLimit|null findOneById(int $id) Return the first ChildLimit filtered by the id column
 * @method     ChildLimit|null findOneByChannel(int $channel) Return the first ChildLimit filtered by the channel column
 * @method     ChildLimit|null findOneByMeasure(int $measure) Return the first ChildLimit filtered by the measure column
 * @method     ChildLimit|null findOneByRate(int $rate) Return the first ChildLimit filtered by the rate column
 * @method     ChildLimit|null findOneByMinutes(int $minutes) Return the first ChildLimit filtered by the minutes column *

 * @method     ChildLimit requirePk($key, ConnectionInterface $con = null) Return the ChildLimit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLimit requireOne(ConnectionInterface $con = null) Return the first ChildLimit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLimit requireOneById(int $id) Return the first ChildLimit filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLimit requireOneByChannel(int $channel) Return the first ChildLimit filtered by the channel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLimit requireOneByMeasure(int $measure) Return the first ChildLimit filtered by the measure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLimit requireOneByRate(int $rate) Return the first ChildLimit filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLimit requireOneByMinutes(int $minutes) Return the first ChildLimit filtered by the minutes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLimit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLimit objects based on current ModelCriteria
 * @method     ChildLimit[]|ObjectCollection findById(int $id) Return ChildLimit objects filtered by the id column
 * @method     ChildLimit[]|ObjectCollection findByChannel(int $channel) Return ChildLimit objects filtered by the channel column
 * @method     ChildLimit[]|ObjectCollection findByMeasure(int $measure) Return ChildLimit objects filtered by the measure column
 * @method     ChildLimit[]|ObjectCollection findByRate(int $rate) Return ChildLimit objects filtered by the rate column
 * @method     ChildLimit[]|ObjectCollection findByMinutes(int $minutes) Return ChildLimit objects filtered by the minutes column
 * @method     ChildLimit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LimitQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Otp\Model\Base\LimitQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'otp', $modelName = '\\Otp\\Model\\Limit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLimitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLimitQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLimitQuery) {
            return $criteria;
        }
        $query = new ChildLimitQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildLimit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LimitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LimitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLimit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, channel, measure, rate, minutes FROM otp_limit WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildLimit $obj */
            $obj = new ChildLimit();
            $obj->hydrate($row);
            LimitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildLimit|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LimitTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LimitTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LimitTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LimitTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LimitTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the channel column
     *
     * @param     mixed $channel The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByChannel($channel = null, $comparison = null)
    {
        $valueSet = LimitTableMap::getValueSet(LimitTableMap::COL_CHANNEL);
        if (is_scalar($channel)) {
            if (!in_array($channel, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $channel));
            }
            $channel = array_search($channel, $valueSet);
        } elseif (is_array($channel)) {
            $convertedValues = array();
            foreach ($channel as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $channel = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LimitTableMap::COL_CHANNEL, $channel, $comparison);
    }

    /**
     * Filter the query on the measure column
     *
     * @param     mixed $measure The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByMeasure($measure = null, $comparison = null)
    {
        $valueSet = LimitTableMap::getValueSet(LimitTableMap::COL_MEASURE);
        if (is_scalar($measure)) {
            if (!in_array($measure, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $measure));
            }
            $measure = array_search($measure, $valueSet);
        } elseif (is_array($measure)) {
            $convertedValues = array();
            foreach ($measure as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $measure = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LimitTableMap::COL_MEASURE, $measure, $comparison);
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate(1234); // WHERE rate = 1234
     * $query->filterByRate(array(12, 34)); // WHERE rate IN (12, 34)
     * $query->filterByRate(array('min' => 12)); // WHERE rate > 12
     * </code>
     *
     * @param     mixed $rate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByRate($rate = null, $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(LimitTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(LimitTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LimitTableMap::COL_RATE, $rate, $comparison);
    }

    /**
     * Filter the query on the minutes column
     *
     * Example usage:
     * <code>
     * $query->filterByMinutes(1234); // WHERE minutes = 1234
     * $query->filterByMinutes(array(12, 34)); // WHERE minutes IN (12, 34)
     * $query->filterByMinutes(array('min' => 12)); // WHERE minutes > 12
     * </code>
     *
     * @param     mixed $minutes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function filterByMinutes($minutes = null, $comparison = null)
    {
        if (is_array($minutes)) {
            $useMinMax = false;
            if (isset($minutes['min'])) {
                $this->addUsingAlias(LimitTableMap::COL_MINUTES, $minutes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minutes['max'])) {
                $this->addUsingAlias(LimitTableMap::COL_MINUTES, $minutes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LimitTableMap::COL_MINUTES, $minutes, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLimit $limit Object to remove from the list of results
     *
     * @return $this|ChildLimitQuery The current query, for fluid interface
     */
    public function prune($limit = null)
    {
        if ($limit) {
            $this->addUsingAlias(LimitTableMap::COL_ID, $limit->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the otp_limit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LimitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LimitTableMap::clearInstancePool();
            LimitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LimitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LimitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LimitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LimitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LimitQuery
