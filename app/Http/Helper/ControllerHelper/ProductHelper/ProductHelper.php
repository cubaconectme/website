<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\ProductHelper;

use App\Http\Helper\DataFormatter\Product\ProductFormatter;
use App\Product;
use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductHelper
{
    public $product;

    private $request;

    private $user;

    private $method;

    /**
     * HomeHelper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->method = $this->request->action_type;
        $this->user = $this->request->user();
        $this->init();
    }

    /**
     * Init Actions
     * @return bool
     */
    private function init(){
        if(method_exists($this,$this->method)){
            return $this->{$this->method}();
        }

        return false;
    }

    /**
     * Create New Product
     * product_name: this.product_name,
     * product_description: this.product_description,
     */
   private function createProduct(){
        if(!$this->request->product_name || !$this->request->product_description) {
            return false;
        }
        $this->product = Product::create([
            'name'                  => $this->request->product_name,
            'description'           => $this->request->product_description,
            'product_placeholder'   => $this->request->product_placeholder,
            'image_url'             =>  $this->uploadImage()
        ]);
        $this->product = new ProductFormatter($this->product);
   }


   private function uploadImage(){
       if ($this->request->hasFile('product_image')) {
           $image  = $this->request->file('product_image');
           $name = time().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('images/products'), $name);
           return 'images/products/'.$name;
       }
       return '';
   }

    /**
     * Delete Products
     * @return bool
     */
   private function deleteProduct(){
       if(!$this->request->product_id) {
           return false;
       }
       $this->product = Product::find($this->request->product_id);
       if(!$this->product){
           return false;
       }
       $this->product->delete();

       $this->product = new ProductFormatter($this->product);
   }

    /**
     * Edit Product Info
     * @return bool
     */
   private function editProduct(){
       if(!$this->request->product_id) {
           return false;
       }

       $this->product =  Product::find($this->request->product_id);
       if(!$this->product){
           return false;
       }

       $this->product->name = $this->request->product_name;
       $this->product->description = $this->request->product_description;
       $this->product->product_placeholder = $this->request->product_placeholder;
       $this->product->image_url = $this->uploadImage();
       $this->product->save();
       $this->product = new ProductFormatter($this->product);
   }

}