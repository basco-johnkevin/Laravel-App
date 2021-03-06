<?php

class Order extends Eloquent
{
	public $guarded = [];

	public function dates()
	{
		return array('created_at', 'updated_at', 'shipped_at');
	}

	public function address()
	{
		return $this->belongsTo('Address');
	}

	public function orderItems()
	{
		return $this->hasMany('OrderItem');
	}

	public function getTotalAttribute()
	{
		$total = 0;

		foreach ($this->orderItems as $orderItem) {
			$total += ($orderItem->totalPrice);
		}

		return $total;
	}

	public function getFullNameAttribute()
	{
		return $this['attributes']['first_name'] . ' ' . $this['attributes']['last_name'];
	}

	public function getShippedAtAttribute()
	{
		return new Carbon\Carbon($this['attributes']['shipped_at']);
	}
}