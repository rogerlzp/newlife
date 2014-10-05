<?php

namespace Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Tricks\Repositories\AttributeRepositoryInterface;
use Tricks\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AttributeController extends BaseController
{
    /**
     * Attribute repository.
     *
     * @var \Tricks\Repositories\AttributeRepositoryInterface
     */
    protected $attribute;
    
    /**
     * Product repository.
     *
     * @var \Tricks\Repositories\ProductRepositoryInterface
     */
    protected $product;

    /**
     * Create a new AttributeController instance.
     *
     * @param  \Tricks\Repositories\AttributeRepositoryInterface  $attribute
     * @return void
     */
    public function __construct(AttributeRepositoryInterface $attribute, ProductRepositoryInterface $product)
    {
        parent::__construct();

        $this->attribute = $attribute;
        $this->product = $product;
    }

    /**
     * Show the admin categories index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $attributes = $this->attribute->findAll();

        $this->view('admin.attribute.list', compact('attributes'));
    }

    /**
     * Handle the creation of a attribute.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->attribute->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.attribute.index')
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $attribute = $this->attribute->create($form->getInputData());

        return $this->redirectRoute('admin.attribute.index');
    }
    
    /**
     * Handle the creation of a attribute from product
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate()
    {
    	Log::info("postCreate in AttributeController");

    	$product_id = Input::get('product_id');
    	
    	$form = $this->attribute->getForm();
    
    	Log::info("111111111111111111");
    	if (! $form->isValid()) {
    		Log::info("22222222");
    		return $this->redirectRoute('admin.attribute.index')
    		->withErrors($form->getErrors())
    		->withInput();
    	}
    	Log::info("3333333333333333333");
    
    	$attribute = $this->attribute->create($form->getInputData());
    	
    	$product  = $this->product->findById($product_id);
    	$product->attributes()->attach($attribute->id);
    	
    	$attributes = $this->product->findAttributesById($product_id);
    	
    	//var_dump($attributes);
    //	$attributes = $this->product
    
    	return $attributes;
    }

   
    /**
     * Show the attribute edit form.
     *
     * @param  mixed $id
     * @return \Response
     */
    public function getView($id)
    {
        $attribute = $this->attribute->findById($id);

        $this->view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Handle the editing of a attribute.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postView($id)
    {
        $form = $this->attribute->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.attribute.view', $id)
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $attribute = $this->attribute->update($id, $form->getInputData());

        return $this->redirectRoute('admin.attribute.view', $id);
    }

    /**
     * Delete a attribute from the database.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $this->attribute->delete($id);

        return $this->redirectRoute('admin.attribute.index');
    }
}
