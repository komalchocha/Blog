<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Productcategory;
use GuzzleHttp\Psr7\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportProduct implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
    return Product::all();
     
    }

    public function map($product):array{

      return [
        $product->id,
        $product->name,
        $product->description,
        $product->price,
        $product->image,
        $product->getcategory->categories_name,

    ]; 
   

    }


    public function headings(): array
    
{
return [
  
'id','name','description','price','image','categories_name',
];

}
}

