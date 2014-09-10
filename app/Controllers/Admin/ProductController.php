<?php

namespace Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Tricks\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    /**
     * Product repository.
     *
     * @var \Tricks\Repositories\ProductRepositoryInterface
     */
    protected $products;

    /**
     * Create a new ProductController instance.
     *
     */
    public function __construct(ProductRepositoryInterface $products)
    {
        parent::__construct();

        $this->products = $products;
    }

    /**
     * Show the admin products index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $products = $this->products->findAllPaginated();

        $this->view('admin.product.list', compact('products'));
    }

    /**
     * Handle the creation of a product.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->product->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.product.index')
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $product = $this->products->create($form->getInputData());

        return $this->redirectRoute('admin.product.index');
    }

    /**
     * Update the order of the categories2.
     *
     * @return \Response
     */
    public function postArrange()
    {
        $decoded = Input::get('data');

        if ($decoded) {
            $this->categories2->arrange($decoded);
        }

        return 'ok';
    }

    /**
     * Show the category edit form.
     *
     * @param  mixed $id
     * @return \Response
     */
    public function getView($id)
    {
        $product = $this->products->findById($id);

        $this->view('admin.categories2.edit', compact('category'));
    }

    /**
     * Handle the editing of a category.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postView($id)
    {
        $form = $this->products->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.product.view', $id)
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $product = $this->products->update($id, $form->getInputData());

        return $this->redirectRoute('admin.product.view', $id);
    }

    /**
     * Delete a product from the database.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $this->products->delete($id);

        return $this->redirectRoute('admin.product.index');
    }
    
    /**
     * product create form
     */
    public function getCreate() {
    	$this->view('admin.product.new');	
    }
    
  
    
    public function postCreate()
    {
    	$form = $this->products->getCreationForm();
    
        	if (! $form->isValid()) {
    		return $this->redirectBack([ 'errors' => $form->getErrors() ]);
    	}
    
    	$data = $form->getInputData();
    	$data['user_id'] = Auth::user()->id;
    	
    	$product = $this->products->create($data);
    	
    	return $this->redirectRoute('admin.product.index');

    }
    
    
}
