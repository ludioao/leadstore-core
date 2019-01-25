<?php

namespace LeadStore\Framework\Models\Contracts;

interface ConfigurationInterface
{
    /**
     * Find an Configuration by given Id which returns Configuration Model
     *
     * @param integer $id
     * @return \LeadStore\Framework\Models\Database\Configuration
     */
    public function find($id);

    /**
     * Find an Configuration by given Id which returns Configuration Model
     *
     * @param string $key
     * @return \LeadStore\Framework\Models\Database\Configuration
     */
    public function findByKey($key);

    /**
     * Find an Configuration_value  by  given configurationKey
     *
     * @param string $key
     * @return string $configurationValue
     */
    public function getValueByKey($key);

    /**
     * Set an Configuration value  by  given configuration Key
     *
     * @param string $key
     * @param string $value
     * @return \LeadStore\Framework\Models\Database\Configuration $configuration
     */
    public function setValueByKey($key, $value);

    /**
     * Find an All Configuration which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Create an Configuration
     *
     * @param array $data
     * @return \LeadStore\Framework\Models\Database\Configuration
     */
    public function create($data);
}
