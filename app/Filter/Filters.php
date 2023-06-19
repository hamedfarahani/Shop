<?php

namespace App\Filter;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

abstract class Filters
{

    protected array $defaultOrderBy = [
        'created_at' => 'desc'
    ];
    protected array $validOrderBy = [
        'created_at' => 'desc'
    ];
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * The Eloquent builder.
     *
     * @var Builder $builder
     */
    protected Builder $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $customFilters = [];

    /**
     * @var array
     */
    protected array $filtersType = [];

    /**
     * @var array
     */
    protected array $mapFilters = [];

    /**
     * @var array
     */
    protected array $jalaliFilters = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param BaseRequest $request BaseRequest.
     */
    public function __construct(BaseRequest $request)
    {
        $this->request = $request;

    }

    /**
     * Apply the filters.
     *
     * @param Builder $builder Builder.
     * @return Builder
     * @throws OdinException
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            $field = $this->setField($filter);
            $operator = $this->filters[$filter];
            $value = $this->setValue($operator, $value);
            if (!is_array($value) && (str_contains($filter, 'id') ||  is_numeric($value))){
                $value = convertPersianNumberToEnglish($value);
            }
            $this->findByField($field, $operator, $value);
        }

        foreach ($this->getCustomFilters() as $customFilter => $customFilterValue) {
            $method = $this->mapFilters[$customFilter] ?? $customFilter;

            if (method_exists($this, $method = Str::camel($method))) {
                if (!is_array($customFilterValue)){
                    $customFilterValue =   escapeLike($customFilterValue);
                }
                if (!is_array($customFilterValue) && (str_contains($customFilter, 'id') ||  is_numeric($customFilterValue))){
                    $customFilterValue = convertPersianNumberToEnglish($customFilterValue);
                }
                $this->$method($customFilterValue);
            }
        }

        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)), function ($item) {
            return !is_null($item);
        });
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getCustomFilters(): array
    {
        return array_filter($this->request->only($this->customFilters), function ($item) {
            return !is_null($item);
        });
    }

    /**
     * @param string $filter Filter.
     * @return mixed
     */
    protected function setField(string $filter)
    {
        return $this->mapFilters[$filter] ?? $filter;
    }

    /**
     * @param string $operator Operator.
     * @param mixed $value Value.
     * @return mixed
     */
    protected function setValue(string $operator, mixed $value)
    {

        if ($operator == 'like') {
            if (!is_array($value)) {
                $value = escapeLike($value);
            }
            return '%' . $value . '%';
        }
        return $value;
    }


    /**
     * @param string $field Field.
     * @param string $operator Operator.
     * @param mixed $value Value.
     * @return Builder
     */
    protected function findByField(string $field, string $operator, mixed $value): Builder
    {
        return $this->builder->where($field, $operator, $value);
    }

}
