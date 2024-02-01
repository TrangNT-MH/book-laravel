<?php
namespace App\Filters;

class BookFilter
{
    /**
     * @var string[]
     */
    protected array $filters = [
        'is_active' => BookStatusFilter::class,
        'key' => BookTitleFilter::class,
        'price' => BookPriceFilter::class,
        'sort' => BookSortFilter::class,
        'category' => BookCategoryFilter::class
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function apply($query): mixed
    {
        foreach ($this->receivedFilter() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }
        return $query;
    }

    /**
     * @return array
     */
    public function receivedFilter(): array
    {
        return request()->only(array_keys($this->filters));
    }
}
