<?php

namespace LeadStore\Framework\Cart;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use LeadStore\Framework\Cart\Product as CartFacadeProduct;
use LeadStore\Framework\Models\Database\Product;
use LeadStore\Framework\Models\Repository\ProductRepository;

class Manager
{
    /**
     * AvoRed Cart Session Manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public $sessionManager;

    public $repo;

    /**
     * AvoRed Cart Construct.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public function __construct(SessionManager $manager)
    {
        $this->sessionManager = $manager;
        $this->repo = app()->make(ProductRepository::class);
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string $slug
     * @param int    $qty
     *
     * @return \LeadStore\Framework\Cart\Manager $this
     */
    public function update($slug, $qty): Manager
    {
        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->get($slug);

        if (null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }

        if ($this->canAddToCart($slug, $qty)) {
            $this->destroy($slug);
            $this->add($slug, $qty);
        } else {
            throw new \Exception('Quantidade máxima!');
        }

        return $this;
    }

    /**
     * Get the Current Collection for the Prophetoducts.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSession()
    {
        $sessionKey = $this->getSessionKey();

        return $this->sessionManager->has($sessionKey) ? $this->sessionManager->get($sessionKey) : new Collection;
    }

    /**
     * Get the Session Key for the Session Manager.
     *
     * @return string $sessionKey
     */
    public function getSessionKey()
    {
        return config('avored-framework.cart.session_key') ?? 'cart_products';
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string $slug
     * @param int    $qty
     * @param array  $attribute
     *
     * @return boolean
     */
    public function canAddToCart($slug, $qty, $attribute = [])
    {
        $cartProducts = $this->getSession();
        $product = Product::whereSlug($slug)->first();

        if (null !== $attribute && count($attribute)) {
            $product = $this->repo->getProductVariationWithCombinations($product->id, $attribute);
            $cartProduct = $cartProducts->get($product->slug);
        } else {
            $cartProduct = $cartProducts->get($slug);
        }

        $cartQty = $cartProduct ? $cartProduct->qty() : 0;
        $checkQty = $qty + $cartQty;

        $productQty = (int) $product->qty;

        if ($productQty >= $checkQty) {
            return true;
        }

        return false;
    }

    /**
     * Remove an Item from Cart Products by Slug.
     *
     * @param string $slug
     *
     * @return self $this
     */
    public function destroy($slug): Manager
    {
        $cartProducts = $this->getSession();
        $cartProducts->pull($slug);

        return $this;
    }

    /**
     * Add Product into cart using Slug and Qty.
     *
     * @param string $slug
     * @param int    $qty
     * @param array  $attributes
     *
     * @return \LeadStore\Framework\Cart\Manager $this
     */
    public function add($slug, $qty, $attribute = null): Manager
    {
        $cartProducts = $this->getSession();
        $product = Product::whereSlug($slug)->first();
        $productVariation = false;
        if (null !== $attribute && count($attribute)) {
            $productParent = $product;
            $product = $this->repo->getProductVariationWithCombinations($product->id, $attribute);
            $productVariation = true;
        }

        $price = $product->price;
        $attributes = null;
        $image = $product->image;
        if ($productVariation && !count($product->images)) {
            $image = $productParent->image;
        }

        $cartProduct = new CartFacadeProduct();
        $cartProduct
            ->id($product->id)
            ->name($product->name)
            ->model($product)
            ->qty($qty)
            ->slug($slug)
            ->price($product->price)
            ->image($image)
            ->lineTotal($qty * $price)
            ->attributes($attributes);

        $cartProducts->put($product->slug, $cartProduct);

        $this->sessionManager->put($this->getSessionKey(), $cartProducts);

        return $this;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string $slug
     * @param float  $taxAmount
     *
     * @return \LeadStore\Framework\Cart\Manager $this
     */
    public function updateProductTax($slug, $taxAmount): Manager
    {
        $cartProducts = $this->getSession();
        $cartProduct = $cartProducts->get($slug);

        if (null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }

        $cartProduct->tax($taxAmount);
        $cartProduct->lineTotal($cartProduct->qty() * ($cartProduct->price() + $taxAmount));

        return $this;
    }

    /**
     * Clear the All Cart Products.
     *
     * @return void
     */
    public function clear()
    {
        $this->sessionManager->forget($this->getSessionKey());
    }

    /**
     * Set/Get Cart has Tax.
     *
     * @param null|boolean $flag
     *
     * @return $this|boolean $hasTax
     */
    public function hasTax($flag = null)
    {
        if (null === $flag) {
            return $this->sessionManager->get('hasTax');
        }
        $this->sessionManager->put('hasTax', $flag);
        return $this;
    }

    /**
     * Get the Current Cart Total
     *
     * @return double $total
     */
    public function total($formatted = true)
    {
        $total = 0.00;
        $cartProducts = $this->all();

        foreach ($cartProducts as $product) {
            $total += $product->lineTotal();
        }

        if ($formatted == true) {
            $symbol = Session::get('currency_symbol');
            return $symbol . number_format($total, 2, ',', '.');
        }

        return $total;
    }

    /**
     * Get the List of All the Current Session Cart Products.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $session = $this->getSession();
        $collect = new Collection;
        foreach ($session as $value) {
            if (!is_int($value)) {
                $collect->push($value);
            }
        }
        return $collect;
    }

    /**
     * Get the Current Cart Tax Total
     *
     * @return double $taxTotal
     */
    public function taxTotal($formatted = true)
    {
        $taxTotal = 0.00;
        $cartProducts = $this->all();
        foreach ($cartProducts as $product) {
            $taxTotal += $product->tax();
        }

        if ($formatted == true) {
            $symbol = Session::get('currency_symbol');
            return $symbol . number_format($taxTotal, 2);
        }

        return $taxTotal;
    }

    /**
     * Get the list of all current session cart products as JSON simple data
     *
     * @return array
     */
    public function allJson()
    {
        $items = $this->all();
        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id'         => $item->id(),
                'name'       => $item->name(),
                'image'      => $item->image(),
                'qty'        => $item->qty(),
                'price'      => $item->price(),
                'slug'       => $item->slug(),
                'line_total' => $item->lineTotal()
            ];
        }
        return collect($data)->toJson();
    }

    /**
     * Get the Total Number of Products into the Cart.
     *
     * @return int $count
     */
    public function count()
    {
        return $this->getSession()->count();
    }
}
