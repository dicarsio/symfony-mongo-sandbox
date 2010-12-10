<?php

/**
 * Base class of repository of Car document.
 */
abstract class BaseCarRepository extends \Mondongo\Repository
{
    protected $documentClass = 'Car';

    protected $connectionName = 'mondongo';

    protected $collectionName = 'car';

    protected $isFile = false;

    /**
     * Ensure indexes.
     *
     * @return void
     */
    public function ensureIndexes()
    {
        $this->getCollection()->ensureIndex(array(
            'slug' => 1,
        ), array(
            'unique' => 1,
            'safe' => true,
        ));

    }
}