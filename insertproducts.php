<?php
require 'client.php';
function insertProducts($woocommercearg){
    $logfile = fopen("htdocs/shop/wp-content/plugins/tire-shop/logs.txt", "w");
    set_time_limit(0);
    ignore_user_abort(1);
    $counter = 0;
    $allproducts = file_get_contents("htdocs/shop/wp-content/plugins/tire-shop/allproducts.json");
    $products = json_decode($allproducts);
    foreach($products as $key){
        $counter++;
        fwrite($logfile, $counter);
        $articlemaingroupid = $key->MainGroupId;
        $articlepricelegacy = $key->NetPrice;
        $articlepricelegacy = $articlepricelegacy + 8.196; // Added price
        $articleprice = strval(round($articlepricelegacy,2));
        $articledesc = $key->ArticleText;
        $articleimage = $key->ImageId;
        if(is_null($articleimage)){
            $articleimage = 'no-image.png';
        } elseif(file_exists('/www/apache/domains/www.rettum.ee/htdocs/shop/wp-content/uploads/productimages/'.strval($articleimage).'.jpeg')){
            $articleimage = strval($articleimage).'.jpeg';
        }  else {
            $articleimage = 'no-image.png';
        }
        echo $articleimage;
        $articleaspectratio = $key->AspectRatio;
        $articlebrandname = $key->BrandName;
        $articlediameter = $key->Diameter;
        $articleweight = $key->Weight;
        $articlewidth = $key->Width;
        $articleEAN = $key->EAN;
        $articleradial = $key->Radial;
        if($articleradial == true){
            $articleradial = "+";
        }else{
            $articleradial = "-";
        }
        $articleloadindexint = $key->LoadIndex;
        $articleloadindex = 0;
        if ($articleloadindexint == null){
            $articleloadindex = "-";
        } else{
            $articleloadindex = strval($articleloadindexint);
        }
        $articlespeedindexint = $key->SpeedIndex;
        $articlespeedindex = 0;
        if ($articlespeedindexint == null){
            $articlespeedindex = "-";
        } else{
            $articlespeedindex = strval($articlespeedindexint);
        }
        $articlefueleffiency = $key->FuelEffiency;
        if ($articlefueleffiency == null){
            $articlefueleffiency = "-";
        } else{
            $articlefueleffiency = strval($articlefueleffiency);
        }
        $articlenoiceclass = $key->NoiceClass;
        if ($articlenoiceclass == null){
            $articlenoiceclass = "-";
        } else{
            $articlenoiceclass = strval($articlenoiceclass);
        }
        $articlenoicevalue = $key->NoiceValue;
        if ($articlenoicevalue == null){
            $articlenoicevalue = "-";
        } else{
            $articlenoicevalue = strval($articlenoicevalue);
        }
        $articlequantityavailable = $key->QuantityAvailable;
        $articlemaingroup = 0;
        switch($articlemaingroupid){ // determines the category of product based on id
            case 20:
                $articlemaingroup = 57;
                break;
            case 15:
                $articlemaingroup = 58;
                break;
            case 10:
                $articlemaingroup = 59;
                break;
            case 21:
                $articlemaingroup = 60;
                break;
            case 50:
                $articlemaingroup = 61;
                break;
            case 41:
                $articlemaingroup = 62;
                break;
            case 40:
                $articlemaingroup = 63;
                break;
            case 30:
                $articlemaingroup = 64;
                break;
            case 13:
                $articlemaingroup = 65;
                break;
            case 22:
                $articlemaingroup = 66;
                break;
            case 66:
                $articlemaingroup = 67;
                break;
            case 80:
                $articlemaingroup = 68;
                break;
            case 85:
                $articlemaingroup = 69;
                break;
            case 88:
                $articlemaingroup = 70;
                break;
            case 35:
                $articlemaingroup = 7093;
                break;
            case 48:
                $articlemaingroup = 7094;
                break;
            case 23:
                $articlemaingroup = 10401;
                break;
            case 42:
                $articlemaingroup = 10402;
                break;
            case 24:
                $articlemaingroup = 10403;
                break;
            case 53:
                $articlemaingroup = 10404;
                break;
            default:
                echo "No category set";
        }
        $data = [
        'name' => $articledesc,
        'type' => 'simple',
        'regular_price' => $articleprice,
        'description' => $articledesc,
        'short_description' => $articledesc,
        'sku' => strval($articleEAN),
        'manage_stock' => true,
        'stock_quantity' => $articlequantityavailable,
        'categories' => [
            [
                'id' => $articlemaingroup,
            ],
        ],
        'images' => [
            [
                'src' => 'https://shop.rettum.ee/wp-content/uploads/productimages/'.$articleimage,
            ],
        ],
        'attributes' => [
            [
                'id' => '3',
                'name' => 'Aspect Ratio',
                'variation' => true,
                'options' => strval(round($articleaspectratio,2)),
                'visible' => true,
            ],
            [
                'id' => '4',
                'name' => 'Brand Name',
                'variation' => true,
                'options' => $articlebrandname,
                'visible' => true,
            ],
            [
                'id' => '5',
                'name' => 'Diameter',
                'variation' => true,
                'options' => strval(round($articlediameter,2)),
                'visible' => true,
            ],
            [
                'id' => '6',
                'name' => 'Weight',
                'variation' => true,
                'options' => strval(round($articleweight,2)),
                'visible' => true,
            ],
            [
                'id' => '7',
                'name' => 'Width',
                'variation' => true,
                'options' => strval(round($articlewidth,2)),
                'visible' => true,
            ],
            [
                'id' => '8',
                'name' => 'EAN',
                'variation' => true,
                'options' => $articleEAN,
                'visible' => true,
            ],
            [
                'id' => '9',
                'name' => 'Radial',
                'variation' => true,
                'options' => $articleradial,
                'visible' => true,
            ],
            [
                'id' => '10',
                'name' => 'Load Index',
                'variation' => true,
                'options' => $articleloadindex,
                'visible' => true,
            ],
            [
                'id' => '11',
                'name' => 'Speed Index',
                'variation' => true,
                'options' => $articlespeedindex,
                'visible' => true,
            ],
            [
                'id' => '12',
                'name' => 'Fuel Efficiency',
                'variation' => true,
                'options' => $articlefueleffiency,
                'visible' => true,
            ],
            [
                'id' => '13',
                'name' => 'Noise Class',
                'variation' => true,
                'options' => $articlenoiceclass,
                'visible' => true,
            ],
            [
                'id' => '14',
                'name' => 'Noise Value',
                'variation' => true,
                'options' => $articlenoicevalue,
                'visible' => true,
            ],
        ],
    ];
        try{
            $woocommercearg->post('products', $data);
            echo $counter.'. Inserted';
        } catch (Exception $e) {
            $message = $e->getMessage();
            fwrite($logfile, $message);
            try{
                $update = $woocommercearg->get('products', ['sku' => $articleEAN]);
                $data = [
                    'stock_quantity' => $articlequantityavailable,
                    'regular_price' => $articleprice,
                ];
                $updateid = 0;
                foreach($update as $key){
                    $updateid = $key->id;
                }
            } catch (Exception $e){
                $message = $e->getMessage();
                fwrite($logfile, $message);
                continue;
            }
            try{
                $woocommercearg->put('products/'.$updateid, $data);
                echo $counter."Updated";
            } catch (Exception $e){
                $message = $e->getMessage();
                fwrite($logfile, $message);
                continue;
            }
        }
    }
    fclose($logfile);
}
insertProducts($woocommerce);
?>