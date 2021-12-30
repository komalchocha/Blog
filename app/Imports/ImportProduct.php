<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function RandImg($dir)
    {
        // Initiate array which will contain the image name
        $imgs_arr = array();
        // Check if image directory exists
        if (file_exists($dir) && is_dir($dir) ) {
          
            // Get files from the directory
            $dir_arr = scandir($dir);
            $arr_files = array_diff($dir_arr, array('.','..') );
            foreach ($arr_files as $file) {
              //Get the file path
              $file_path = $dir."/".$file;
              // Get extension
              $ext = pathinfo($file_path, PATHINFO_EXTENSION);
              if ($ext=="jpg" || $ext=="png" || $ext=="JPG" || $ext=="PNG") {
                array_push($imgs_arr, $file);
              }
              
            }
            $count_img_index = count($imgs_arr) - 1;
            return $imgs_arr[rand( 0, $count_img_index )];
        }
    }


    public function model(array $row)
    {
    
    if(!is_string($row[0])) {
        $cat=$row[5];

        $categoryId = Productcategory::where('categories_name','=',strtolower($cat))->first();
         
        
        if(empty($categoryId)){
            
          
            $categoryId = Productcategory::create([
                'categories_name'=>$cat
            ]);
        }
        $random_img = $this->RandImg('storage/image');
//         $url = "http://localhost:8000/storage/image/logo1w.png";
        
// $contents = file_get_contents($url);
// dd($contents);
// $name = substr($url, strrpos($url, '/') + 1);
// Storage::put($random_img);
             $arr=[       
            'name'=>$row[1],
            'description'=>$row[2],
            'price'=>$row[3],
            'image' =>$random_img,
            'category_id'=>$categoryId->id,

        ];

       
     DB::table('products')->insert($arr);
    }
}
}
