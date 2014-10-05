<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attribute';

    /**
     * Query the product that belong to the attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function products()
	{
		return $this->belongsToMany('Tricks\Product', 'product_attribute');
	}
}
