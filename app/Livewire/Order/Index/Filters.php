<?php

namespace App\Livewire\Order\Index;

use Livewire\Form;
use Livewire\Attributes\Url;
use App\Models\Store;

class Filters extends Form
{
    public Store $store;

    #[Url(as: 'products')]
    public $selectedProductIds = [];

    public function init($store)
    {
        $this->store = $store;

        $this->fillSelectedProductIds();
    }

    public function fillSelectedProductIds()
    {
        if (empty($this->selectedProductIds)) {
            $this->selectedProductIds = $this->products()->pluck('id')->toArray();
        }
    }

    public function products()
    {
        return $this->store->products;
    }

    public function apply($query)
    {
        return $query->whereIn('product_id', $this->selectedProductIds);
    }
}
