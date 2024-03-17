<?php

namespace App\Http\Controllers\Admin\Catalog\Feed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

class Facebook extends Controller
{
    protected $xml = [];
	protected $products	= [];
	protected $title;
	protected $description;
	protected $link;
	protected $currency;

	public function setTitle($title = ""){
		$this->title = $title;
	}
    public function setCurrency($currency = ""){
		$this->currency = $currency;
	}
	public function setDescription($description = ""){
		$this->description = $description;
	}
	public function setLink($link = ""){
		$this->link = $link;
	}
	public function addItem(
        $id,
        $availability,
        $condition = 'New',
		$description,
		$image_link,
		$link,
		$title,
		$price,
		$brand,
		// Optional
		$product_type = NULL,
		$custom_fields = NULL
	){
		$product = [
			"g:id" => $id,
            "g:availability" => ($availability > 0) ? 'in sotck' : 'out of stock',
			"g:condition" => $condition,
            "g:description" => strip_tags($description),
            "g:image_link" => $image_link,
            "g:link" => $link . "?utm_source=facebook&utm_medium=facebookCatalog&utm_campaign=",
            "g:title" => $title,
            "g:price" => $this->currency.' '.number_format($price, 2, ".", ","),
            "g:brand" => $brand,
		];
		if(!is_null($product_type)):
			$product['g:product_type'] = $product_type;
        endif;
		if(!is_null($custom_fields)):
			foreach ($custom_fields as $key => $value):
				$product["g:" . $key] = $value;
            endforeach;
		endif;
		$this->products[] = $product;
	}
	public function generate(){
		$this->xml = [
		    'rss' 	=> [
		        '_attributes' => [
		            'xmlns:g' => 'http://base.google.com/ns/1.0',
		            'version' => '2.0',
		        ],
		        'channel' => [
		        	'title'	=> $this->title,
		        	'description' => $this->description,
		        	'link' => $this->link,
		        ]
		    ]
		];
		$i = 0;
        foreach ($this->products as $product) {
			$this->xml['rss']['channel']['item_'.$i] = $product;
			$i++;
		}
		$xml = ArrayToXml::convert($this->xml, '');
		$xml = str_replace(['    ', '<root>', '</root>', "\n", "\r", '<remove>remove</remove>'], '', $xml);
		$xml = preg_replace([
			"/item_[0-9][0-9][0-9][0-9]/",
			"/item_[0-9][0-9][0-9]/",
			"/item_[0-9][0-9]/",
			"/item_[0-9]/",
		], "item", $xml);
		return $xml;
	}
	public function display(){
		return response($this->generate())->header('Content-Type', 'text/xml');
	}
}
