<?php

namespace Ricoa\Auth\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WhereInCriteria
 * @package namespace Ricoa\Auth\Criteria;
 */
class WhereInCriteria implements CriteriaInterface
{

    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $data;


    /**
     * WhereInCriteria constructor.
     *
     * @param $field
     * @param $data
     */
    public function __construct($field,$data)
    {

        $this->field = $field;
        $this->data = $data;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereIn($this->field,$this->data);
    }
}
