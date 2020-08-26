<?php

namespace Otp\Model\Base;

use \Exception;
use \PDO;
use Otp\Model\Otp as ChildOtp;
use Otp\Model\OtpQuery as ChildOtpQuery;
use Otp\Model\Map\OtpTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'otp' table.
 *
 *
 *
 * @method     ChildOtpQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOtpQuery orderByChannel($order = Criteria::ASC) Order by the channel column
 * @method     ChildOtpQuery orderByTarget($order = Criteria::ASC) Order by the target column
 * @method     ChildOtpQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildOtpQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     ChildOtpQuery orderByExpireAt($order = Criteria::ASC) Order by the expire_at column
 * @method     ChildOtpQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildOtpQuery groupById() Group by the id column
 * @method     ChildOtpQuery groupByChannel() Group by the channel column
 * @method     ChildOtpQuery groupByTarget() Group by the target column
 * @method     ChildOtpQuery groupByPassword() Group by the password column
 * @method     ChildOtpQuery groupByIp() Group by the ip column
 * @method     ChildOtpQuery groupByExpireAt() Group by the expire_at column
 * @method     ChildOtpQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildOtpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOtpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOtpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOtpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOtpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOtpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOtp findOne(ConnectionInterface $con = null) Return the first ChildOtp matching the query
 * @method     ChildOtp findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOtp matching the query, or a new ChildOtp object populated from the query conditions when no match is found
 *
 * @method     ChildOtp findOneById(int $id) Return the first ChildOtp filtered by the id column
 * @method     ChildOtp findOneByChannel(int $channel) Return the first ChildOtp filtered by the channel column
 * @method     ChildOtp findOneByTarget(string $target) Return the first ChildOtp filtered by the target column
 * @method     ChildOtp findOneByPassword(string $password) Return the first ChildOtp filtered by the password column
 * @method     ChildOtp findOneByIp(string $ip) Return the first ChildOtp filtered by the ip column
 * @method     ChildOtp findOneByExpireAt(string $expire_at) Return the first ChildOtp filtered by the expire_at column
 * @method     ChildOtp findOneByCreatedAt(string $created_at) Return the first ChildOtp filtered by the created_at column *

 * @method     ChildOtp requirePk($key, ConnectionInterface $con = null) Return the ChildOtp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOne(ConnectionInterface $con = null) Return the first ChildOtp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtp requireOneById(int $id) Return the first ChildOtp filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByChannel(int $channel) Return the first ChildOtp filtered by the channel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByTarget(string $target) Return the first ChildOtp filtered by the target column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByPassword(string $password) Return the first ChildOtp filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByIp(string $ip) Return the first ChildOtp filtered by the ip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByExpireAt(string $expire_at) Return the first ChildOtp filtered by the expire_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtp requireOneByCreatedAt(string $created_at) Return the first ChildOtp filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtp[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOtp objects based on current ModelCriteria
 * @method     ChildOtp[]|ObjectCollection findById(int $id) Return ChildOtp objects filtered by the id column
 * @method     ChildOtp[]|ObjectCollection findByChannel(int $channel) Return ChildOtp objects filtered by the channel column
 * @method     ChildOtp[]|ObjectCollection findByTarget(string $target) Return ChildOtp objects filtered by the target column
 * @method     ChildOtp[]|ObjectCollection findByPassword(string $password) Return ChildOtp objects filtered by the password column
 * @method     ChildOtp[]|ObjectCollection findByIp(string $ip) Return ChildOtp objects filtered by the ip column
 * @method     ChildOtp[]|ObjectCollection findByExpireAt(string $expire_at) Return ChildOtp objects filtered by the expire_at column
 * @method     ChildOtp[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOtp objects filtered by the created_at column
 * @method     ChildOtp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OtpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Otp\Model\Base\OtpQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'otp', $modelName = '\\Otp\\Model\\Otp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOtpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOtpQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOtpQuery) {
            return $criteria;
        }
        $query = new ChildOtpQuery();
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
     * @return ChildOtp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OtpTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OtpTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOtp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, channel, target, password, ip, expire_at, created_at FROM otp WHERE id = :p0';
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
            /** @var ChildOtp $obj */
            $obj = new ChildOtp();
            $obj->hydrate($row);
            OtpTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOtp|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OtpTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OtpTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OtpTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OtpTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the channel column
     *
     * @param     mixed $channel The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByChannel($channel = null, $comparison = null)
    {
        $valueSet = OtpTableMap::getValueSet(OtpTableMap::COL_CHANNEL);
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

        return $this->addUsingAlias(OtpTableMap::COL_CHANNEL, $channel, $comparison);
    }

    /**
     * Filter the query on the target column
     *
     * Example usage:
     * <code>
     * $query->filterByTarget('fooValue');   // WHERE target = 'fooValue'
     * $query->filterByTarget('%fooValue%', Criteria::LIKE); // WHERE target LIKE '%fooValue%'
     * </code>
     *
     * @param     string $target The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByTarget($target = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($target)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_TARGET, $target, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%', Criteria::LIKE); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the expire_at column
     *
     * Example usage:
     * <code>
     * $query->filterByExpireAt('2011-03-14'); // WHERE expire_at = '2011-03-14'
     * $query->filterByExpireAt('now'); // WHERE expire_at = '2011-03-14'
     * $query->filterByExpireAt(array('max' => 'yesterday')); // WHERE expire_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $expireAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByExpireAt($expireAt = null, $comparison = null)
    {
        if (is_array($expireAt)) {
            $useMinMax = false;
            if (isset($expireAt['min'])) {
                $this->addUsingAlias(OtpTableMap::COL_EXPIRE_AT, $expireAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expireAt['max'])) {
                $this->addUsingAlias(OtpTableMap::COL_EXPIRE_AT, $expireAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_EXPIRE_AT, $expireAt, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OtpTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OtpTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtpTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOtp $otp Object to remove from the list of results
     *
     * @return $this|ChildOtpQuery The current query, for fluid interface
     */
    public function prune($otp = null)
    {
        if ($otp) {
            $this->addUsingAlias(OtpTableMap::COL_ID, $otp->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the otp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OtpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OtpTableMap::clearInstancePool();
            OtpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OtpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OtpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OtpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OtpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Order by create date desc
     *
     * @return     $this|ChildOtpQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(OtpTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildOtpQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(OtpTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildOtpQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(OtpTableMap::COL_CREATED_AT);
    }

} // OtpQuery
