<?php

/**
 * Base class of Car document.
 */
abstract class BaseCar extends \Mondongo\Document\Document implements \ArrayAccess
{
    protected $data = array(
        'fields' => array(
            'make' => null,
            'model' => null,
            'created_at' => null,
            'updated_at' => null,
            'slug' => null,
        ),
    );

    protected $fieldsModified = array(

    );

    /**
     * Returns the Mondongo of the document.
     *
     * @return Mondongo\Mondongo The Mondongo of the document.
     */
    public function getMondongo()
    {
        return \Mondongo\Container::getForDocumentClass('Car');
    }

    /**
     * Returns the repository of the document.
     *
     * @return Mondongo\Repository The repository of the document.
     */
    public function getRepository()
    {
        return $this->getMondongo()->getRepository('Car');
    }

    protected function updateTimestampableCreated()
    {
        $this->setCreatedAt(new \DateTime());
    }

    protected function updateTimestampableUpdated()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    protected function updateSluggableSlug()
    {
        $slug = $proposal = call_user_func(array (
  0 => '\\Mondongo\\Behavior\\Sluggable',
  1 => 'slugify',
), $this->getModel());

        $similarSlugs = array();
        foreach ($this->getRepository()
            ->getCollection()
            ->find(array('slug' => new \MongoRegex('/^'.$slug.'/')))
        as $result) {
            $similarSlugs[] = $result['slug'];
        }

        $i = 1;
        while (in_array($slug, $similarSlugs)) {
            $slug = $proposal.'-'.++$i;
        }

        $this->setSlug($slug);
    }

    /**
     * Set the data in the document (hydrate).
     *
     * @return void
     */
    public function setDocumentData($data)
    {
        $this->id = $data['_id'];

        if (isset($data['make'])) {
            $this->data['fields']['make'] = (string) $data['make'];
        }
        if (isset($data['model'])) {
            $this->data['fields']['model'] = (string) $data['model'];
        }
        if (isset($data['created_at'])) {
            $date = new \DateTime(); $date->setTimestamp($data['created_at']->sec); $this->data['fields']['created_at'] = $date;
        }
        if (isset($data['updated_at'])) {
            $date = new \DateTime(); $date->setTimestamp($data['updated_at']->sec); $this->data['fields']['updated_at'] = $date;
        }
        if (isset($data['slug'])) {
            $this->data['fields']['slug'] = (string) $data['slug'];
        }


        
    }

    /**
     * Convert an array of fields with data to Mongo values.
     *
     * @param array $fields An array of fields with data.
     *
     * @return array The fields with data in Mongo values.
     */
    public function fieldsToMongo($fields)
    {
        if (isset($fields['make'])) {
            $fields['make'] = (string) $fields['make'];
        }
        if (isset($fields['model'])) {
            $fields['model'] = (string) $fields['model'];
        }
        if (isset($fields['created_at'])) {
            if ($fields['created_at'] instanceof \DateTime) { $fields['created_at'] = $fields['created_at']->getTimestamp(); } elseif (is_string($fields['created_at'])) { $fields['created_at'] = strtotime($fields['created_at']); } $fields['created_at'] = new \MongoDate($fields['created_at']);
        }
        if (isset($fields['updated_at'])) {
            if ($fields['updated_at'] instanceof \DateTime) { $fields['updated_at'] = $fields['updated_at']->getTimestamp(); } elseif (is_string($fields['updated_at'])) { $fields['updated_at'] = strtotime($fields['updated_at']); } $fields['updated_at'] = new \MongoDate($fields['updated_at']);
        }
        if (isset($fields['slug'])) {
            $fields['slug'] = (string) $fields['slug'];
        }


        return $fields;
    }

    /**
     * Set the "make" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setMake($value)
    {
        if (!array_key_exists('make', $this->fieldsModified)) {
            $this->fieldsModified['make'] = $this->data['fields']['make'];
        } elseif ($value === $this->fieldsModified['make']) {
            unset($this->fieldsModified['make']);
        }

        $this->data['fields']['make'] = $value;
    }

    /**
     * Returns the "make" field.
     *
     * @return mixed The make field.
     */
    public function getMake()
    {
        return $this->data['fields']['make'];
    }

    /**
     * Set the "model" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setModel($value)
    {
        if (!array_key_exists('model', $this->fieldsModified)) {
            $this->fieldsModified['model'] = $this->data['fields']['model'];
        } elseif ($value === $this->fieldsModified['model']) {
            unset($this->fieldsModified['model']);
        }

        $this->data['fields']['model'] = $value;
    }

    /**
     * Returns the "model" field.
     *
     * @return mixed The model field.
     */
    public function getModel()
    {
        return $this->data['fields']['model'];
    }

    /**
     * Set the "created_at" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setCreatedAt($value)
    {
        if (!array_key_exists('created_at', $this->fieldsModified)) {
            $this->fieldsModified['created_at'] = $this->data['fields']['created_at'];
        } elseif ($value === $this->fieldsModified['created_at']) {
            unset($this->fieldsModified['created_at']);
        }

        $this->data['fields']['created_at'] = $value;
    }

    /**
     * Returns the "created_at" field.
     *
     * @return mixed The created_at field.
     */
    public function getCreatedAt()
    {
        return $this->data['fields']['created_at'];
    }

    /**
     * Set the "updated_at" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setUpdatedAt($value)
    {
        if (!array_key_exists('updated_at', $this->fieldsModified)) {
            $this->fieldsModified['updated_at'] = $this->data['fields']['updated_at'];
        } elseif ($value === $this->fieldsModified['updated_at']) {
            unset($this->fieldsModified['updated_at']);
        }

        $this->data['fields']['updated_at'] = $value;
    }

    /**
     * Returns the "updated_at" field.
     *
     * @return mixed The updated_at field.
     */
    public function getUpdatedAt()
    {
        return $this->data['fields']['updated_at'];
    }

    /**
     * Set the "slug" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setSlug($value)
    {
        if (!array_key_exists('slug', $this->fieldsModified)) {
            $this->fieldsModified['slug'] = $this->data['fields']['slug'];
        } elseif ($value === $this->fieldsModified['slug']) {
            unset($this->fieldsModified['slug']);
        }

        $this->data['fields']['slug'] = $value;
    }

    /**
     * Returns the "slug" field.
     *
     * @return mixed The slug field.
     */
    public function getSlug()
    {
        return $this->data['fields']['slug'];
    }

    /**
     * Set a data by name.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return void
     */
    public function set($name, $value)
    {
        if ('make' == $name) {
            return $this->setMake($value);
        }
        if ('model' == $name) {
            return $this->setModel($value);
        }
        if ('created_at' == $name) {
            return $this->setCreatedAt($value);
        }
        if ('updated_at' == $name) {
            return $this->setUpdatedAt($value);
        }
        if ('slug' == $name) {
            return $this->setSlug($value);
        }

        throw new \InvalidArgumentException(sprintf('The data "%s" does not exists.', $name));
    }

    /**
     * Get a data by name.
     *
     * @param string $name  The data name.
     *
     * @return mixed The data value.
     */
    public function get($name)
    {
        if ('make' == $name) {
            return $this->getMake();
        }
        if ('model' == $name) {
            return $this->getModel();
        }
        if ('created_at' == $name) {
            return $this->getCreatedAt();
        }
        if ('updated_at' == $name) {
            return $this->getUpdatedAt();
        }
        if ('slug' == $name) {
            return $this->getSlug();
        }

        throw new \InvalidArgumentException(sprintf('The data "%s" does not exists.', $name));
    }

    /**
     * Import data from an array.
     *
     * @param array $array An array.
     *
     * @return void
     */
    public function fromArray($array)
    {
        if (isset($array['make'])) {
            $this->set('make', $array['make']);
        }
        if (isset($array['model'])) {
            $this->set('model', $array['model']);
        }
        if (isset($array['created_at'])) {
            $this->set('created_at', $array['created_at']);
        }
        if (isset($array['updated_at'])) {
            $this->set('updated_at', $array['updated_at']);
        }
        if (isset($array['slug'])) {
            $this->set('slug', $array['slug']);
        }

    }

    /**
     * Export the document data to an array.
     *
     * @param bool $withEmbeddeds If export embeddeds or not.
     *
     * @return array An array with the document data.
     */
    public function toArray($withEmbeddeds = true)
    {
        $array = array();

        if (null !== $this->data['fields']['make']) {
            $array['make'] = $this->data['fields']['make'];
        }
        if (null !== $this->data['fields']['model']) {
            $array['model'] = $this->data['fields']['model'];
        }
        if (null !== $this->data['fields']['created_at']) {
            $array['created_at'] = $this->data['fields']['created_at'];
        }
        if (null !== $this->data['fields']['updated_at']) {
            $array['updated_at'] = $this->data['fields']['updated_at'];
        }
        if (null !== $this->data['fields']['slug']) {
            $array['slug'] = $this->data['fields']['slug'];
        }


        if ($withEmbeddeds) {

        }

        return $array;
    }

    public function preInsertExtensions()
    {
        $this->updateTimestampableCreated();
        $this->updateSluggableSlug();

    }

    public function postInsertExtensions()
    {

    }

    public function preUpdateExtensions()
    {
        $this->updateTimestampableUpdated();

    }

    public function postUpdateExtensions()
    {

    }

    public function preSaveExtensions()
    {

    }

    public function postSaveExtensions()
    {

    }

    public function preDeleteExtensions()
    {

    }

    public function postDeleteExtensions()
    {

    }

    /**
     * Throws an \LogicException because you cannot check if data exists.
     *
     * @throws \LogicException
     */
    public function offsetExists($name)
    {
        throw new \LogicException('You cannot check if data exists in a document.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return void
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetSet($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * Throws a \LogicException because you cannot unset data in the document.
     *
     * @throws \LogicException
     */
    public function offsetUnset($name)
    {
        throw new \LogicException('You cannot unset data in the document.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return void
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Returns the data map.
     *
     * @return array The data map.
     */
    static public function getDataMap()
    {
        return array(
            'fields' => array(
                'make' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'model' => array(
                    'type' => 'string',
                    'required' => false,
                ),
                'created_at' => array(
                    'type' => 'date',
                ),
                'updated_at' => array(
                    'type' => 'date',
                ),
                'slug' => array(
                    'type' => 'string',
                ),
            ),
            'references' => array(

            ),
            'embeddeds' => array(

            ),
            'relations' => array(

            ),
        );
    }
}