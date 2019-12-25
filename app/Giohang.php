<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giohang extends Model
{
    public $items = null;
	public $totalQty = 0; // tong so luong san pham
	public $totalPrice = 0; // tong gia san pham

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		if($item->promotion_price == 0){
			$giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item];
		}
		else{
			$giohang = ['qty'=>0, 'price' => $item->promotion_price, 'item' => $item];
		}
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang['qty']++;
		if($item->promotion_price == 0){
			$giohang['price'] = $item->price * $giohang['qty'];
		}
		else{
			$giohang['price'] = $item->promotion_price * $giohang['qty'];
		}
		$this->items[$id] = $giohang;
		$this->totalQty++;
		if($item->promotion_price == 0){
			$this->totalPrice += $item->price;
		}
		else{
			$this->totalPrice += $item->promotion_price;
		}
		
	}

	// update cart
	public function update_cart($id,$newQty){
		$present_qty = $this->items[$id]['qty'];
		
		if( $present_qty > $newQty){
			$this->items[$id]['qty'] = $newQty;
			$this->items[$id]['price'] = $this->items[$id]['item']['price'] * $newQty;
			$cut = $present_qty - $newQty;
			$this->totalQty -= $cut;
			$this->totalPrice -= $this->items[$id]['item']['price'];
			if($this->items[$id]['qty']<=0){
				unset($this->items[$id]);
			}
		}

		if($present_qty < $newQty){
			$this->items[$id]['qty'] = $newQty;
			$this->items[$id]['price'] = $this->items[$id]['item']['price'] * $newQty;
			$add = $newQty - $present_qty;
			$this->totalQty += $add;
			$this->totalPrice += $this->items[$id]['item']['price'];
			if($this->items[$id]['qty']<=0){
				unset($this->items[$id]);
			}
		}

	}

	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
