<?php

/**
 * This file is part of the "byng/pimcore-elasticsearch-plugin" project.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the LICENSE is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byng\Pimcore\Elasticsearch\Query;

/**
 * Match Query
 *
 * Encapsulates a "match" query's data.
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class MatchQuery implements Query
{
    const OPERATOR_AND = "and";
    const OPERATOR_OR = "or";

    /**
     * @var string
     */
    private $field;

    /**
     * @var string|array
     */
    private $query;

    /**
     * @var string
     */
    private $operator;


    /**
     * MatchQuery constructor.
     *
     * @param string       $field
     * @param string|array $query
     * @param string       $operator
     */
    public function __construct($field, $query, $operator = self::OPERATOR_AND)
    {
        $this->field = $field;
        $this->query = $query;
        $this->operator = $operator;

        switch ($this->operator) {
            case self::OPERATOR_AND:
            case self::OPERATOR_OR:
                break;
            default:
                throw new \InvalidArgumentException(sprintf(
                    "Unexpected operator found: '%s'",
                    $this->operator
                ));
        }
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Get query
     *
     * @return array|string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return "match";
    }
}
