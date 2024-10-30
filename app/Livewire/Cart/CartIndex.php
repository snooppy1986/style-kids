<?php

namespace App\Livewire\Cart;

use App\Classes\NewPost;
use App\Models\Customer;
use App\Models\DeliveryCompany;
use App\Models\NewPostArea;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartIndex extends Component
{
    public $products;
    public $products_count;
    public $total_price;

    /*#[Validate('required|min:2|max:64')]*/
    #[Validate('required', message: 'Please provide a name')]
    #[Validate('min:2', message: 'The name is short')]
    #[Validate('max:64', message: 'The name is long')]
    public $name;
    #[Validate('required', message: 'Please provide a surname')]
    #[Validate('min:2', message: 'The surname is short')]
    #[Validate('max:64', message: 'The surname is long')]
    public $surname;
    #[Validate('required', message: 'Please provide a phone number')]
    #[Validate('numeric', message: 'The phone number must be numeric')]
    public $phone='380';
    #[Validate('email', message: 'Enter correct email')]
    public $email;

    public $delivery_companies;
    public $delivery_company;
    public $areas=null;
    public $area=null;
    public $area_id=null;
    public $cities=null;
    public $city=null;
    public $city_id=null;
    public $warehouses=null;
    public $warehouse=null;
    public $new_post_key=null;
    public ?object $size=null;


    protected $listeners=['cities', 'warehouses', 'set_warehouses'];

    public function mount()
    {
        $this->delivery_companies = DeliveryCompany::query()
            ->where('status', '=', 1)
            ->get();

        if(Session::has('p_c')){
            foreach (Session::get('p_c') as $item){
                /*dd($item);*/
                $this->products_count[$item['product_id']] = $item['count'];
            }
        }
        $this->getTotalPrice($this->products, $this->products_count);
    }

    public function deliveryType($company_id)
    {
        if($company_id == 1){
            $this->areas();
            $this->delivery_company = $company_id;
        }elseif ($company_id == 2){
            dump('Укрпочта');
            /*$this->areas();;
            $this->cities = null;
            $this->warehouses = null;*/
        }

    }
    public function areas()
    {
        $this->areas = NewPostArea::query()->get();
    }
    public function cities($area_id)
    {
        $this->area_id = $area_id;
        $this->area = NewPostArea::query()
            ->where('Ref', $area_id)
            ->first()->DescriptionRu;
        $this->warehouses = null;
        $this->cities = NewPostCity::query()
            ->where('Area', '=', $area_id)
            ->get();
    }
    public function warehouses($city_id)
    {
        $this->city_id = $city_id;
        $this->city = NewPostCity::query()
            ->where('Ref', $city_id)
            ->first()->DescriptionRu;
        $this->warehouses = NewPostWarehouse::query()
            ->where('CityRef', '=', $city_id)
            ->get();
    }

    public function set_warehouses($warehouse_id)
    {
        $this->warehouse = NewPostWarehouse::query()
            ->where('Ref', $warehouse_id)
            ->first()->DescriptionRu;
    }

    public function clearCart()
    {
        Session::forget('p_c');
        $this->products = null;
        $this->dispatch('updateCount');
    }
    public function remove($key)
    {
        $session_data = Session::get('p_c');
        unset($session_data[$key]);
        unset($this->products[$key]);

        foreach (Session::get('p_c') as $item){
            $this->products_count[$item['product_id']] = $item['count'];
        }
        $this->getTotalPrice($this->products, $this->products_count);
        Session::put('p_c', $session_data);
        $this->dispatch('updateCount');
    }
    public function getTotalPrice($products, $products_counts)
    {
        $this->total_price = 0;
        if($products){
            foreach ($products as $key=>$product){
                /*dd($product, $products_counts);*/
                $price = $product['first_skus']
                    ? $product['first_skus']['discount_price'] ? $product['first_skus']['discount_price'] : $product['first_skus']['price']
                    : 0;
                $this->total_price += $price*$products_counts[$key];
            }
        }
    }

    #[NoReturn]
    public function updateCount($key, $value)
    {
        $session_data = Session::get('p_c');
        $session_data[$key]['count'] = $value;
        Session::put('p_c', $session_data);
        $this->products_count[$key] = $value;
        $this->getTotalPrice($this->products, $this->products_count);
        $this->dispatch('updateCount');
    }

    public function setSize($product_key, $size_id)
    {
       $this->products[$product_key]['size_id'] = $size_id;
       $session_data = Session::get('p_c');
       $session_data[$product_key]['size_id'] = $size_id;
        Session::put('p_c', $session_data);
    }

    public function editPhoneNumber()
    {
        if(strlen($this->phone)<4){
            $this->phone = '380';
        }
        if(strlen($this->phone)>12){
            $this->phone = substr($this->phone, 0, -1);
        }
    }
    public function saveOrder()
    {
        /*dd($this->products);*/
        $this->validate();
        /*dd($this->name);*/
        $customer = Customer::query()->create([
            'name' => $this->name.' '.$this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $order = Order::query()
            ->create([
                'number' => 'OR'.time(),
                'customer_id' => $customer->id,
                'total_price' => $this->total_price,
                'status' => 'new',
                'currency' => 'UAH',
                'shipping_method' => $this->delivery_company
            ]);

        $order->delivery()->create([
            'type' => /*$this->delivery_companies->where('id', 1)->first()->name*/ 'test',
            'area' => $this->area,
            'city' => $this->city,
            'warehouse' => $this->warehouse
        ]);
        if($this->products){
            foreach ($this->products as $product){
                $order->order_products()->create([
                    'product_id' => $product['id'],
                    'sku_id' => $product['first_skus']['id'],
                    'qty' => $product['count'],
                    'unit_price' => $product['first_skus']['discount_price']
                        ? $product['first_skus']['discount_price']
                        : $product['first_skus']['price'],
                    'size' => $product['size_value']
                ]);
            }
        }
        $this->clearCart();
        return $this->redirectRoute('order.complete', navigate: true);
    }
    public function render()
    {
        return view('livewire.cart.cart-index');
    }

    public function changeProductSize($value, $product_id): void
    {
        $this->products[$product_id]['size'] = $value;
        /*dd($value, $product_id, $this->products);*/
    }

    public function changeProductSku($sku_id, $product_id): void
    {
        $this->products[$product_id]['readyForPurchase'] = true;
        $this->products[$product_id]['sku_id'] = $sku_id;
        /*dd($this->products[$product_id]);*/
    }
}
