<?php

namespace Tricks\Repositories\Eloquent;

use Tricks\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Tricks\Services\Forms\AttributeForm;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\AttributeRepositoryInterface;

class AttributeRepository extends AbstractRepository implements AttributeRepositoryInterface
{
    /**
     * Create a new AttributeRepository instance.
     *
     * @param  \Tricks\Attribute  $attribute
     * @return void
     */
    public function __construct(Attribute $attribute)
    {
        $this->model = $attribute;
    }

    /**
     * Get an array of key-value pairs of all attributes.
     *
     * @return array
     */
    public function listAll()
    {
        $attributes = $this->model->lists('name', 'id');

        return $attributes;
    }

    /**
     * Find all attributes.
     *
     * @param  string  $orderColumn
     * @param  string  $orderDir
     * @return \Illuminate\Database\Eloquent\Collection|\Attribute[]
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        $attributes = $this->model
                           ->orderBy($orderColumn, $orderDir)
                           ->get();

        return $attributes;
    }

    /**
     * Find all attributes with the associated number of prodcuts.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Product[]
     */
    /*
    public function findAllWithTrickCount()
    {
        return $this->model->leftJoin('category_trick', 'categories.id', '=', 'category_trick.category_id')
                           ->leftJoin('tricks', 'tricks.id', '=', 'category_trick.trick_id')
                           ->groupBy('categories.slug')
                           ->orderBy('trick_count', 'desc')
                           ->get([
                               'categories.name',
                               'categories.slug',
                               DB::raw('COUNT(tricks.id) as trick_count')
                           ]);
    }
     */
    /**
     * Find a attribute by id.
     *
     * @param  mixed $id
     * @return \Tricks\Attribute
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new attribute in the database.
     *
     * @param  array $data
     * @return \Tricks\Attribute
     */
    public function create(array $data)
    {
        $attribute = $this->getNew();

        $attribute->name        = e($data['name']);
      //  $attribute->slug        = Str::slug($category->name, '-');
      //  $attribute->description = $data['description'];
        $attribute->value       = $data['value'];

        $attribute->save();

        return $attribute;
    }

    /**
     * Update the specified attribute in the database.
     *
     * @param  mixed $id
     * @param  array $data
     * @return \Tricks\Attribute
     */
    public function update($id, array $data)
    {
        $attribute = $this->findById($id);

        $attribute->name         = e($data['name']);
        $attribute->value  = $data['value'];

        $attribute->save();

        return $attribute;
    }

    /**
     * The the highest order number from the database.
     *
     * @return int
     */
    public function getMaxOrder()
    {
        return $this->model->max('order');
    }

    /**
     * Delete the specified category from the database.
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $attribute = $this->findById($id);
        $attribute->products()->detach();
        $attribute->delete();
    }


    /**
     * Get the attribute create/update form service.
     *
     * @return \Tricks\Services\Forms\AttributeForm
     */
    public function getForm()
    {
        return new AttributeForm;
    }
}
