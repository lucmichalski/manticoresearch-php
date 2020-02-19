<?php


namespace Manticoresearch\Endpoints\Nodes;

use Manticoresearch\Endpoints\EmulateBySql;
use Manticoresearch\Exceptions\RuntimeException;

class CreateFunction extends EmulateBySql
{
    /**
     * @var string
     */
    protected $_index;

    public function setBody($params)
    {
        if (iseet($params['name']) && isset($params['type']) && $params['library']) {
            return parent::setBody(['query' => "CREATE FUNCTION " . $params['name'] . " RETURNS " . strtoupper($params['type']) . " SONAME " . $params['library']]);
        }
        throw new RuntimeException('Incomplete request for /nodes/createplugin');
    }
}