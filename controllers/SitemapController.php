<?php

namespace app\controllers;

use Yii;
use DOMDocument;
use DOMElement;
use DOMText;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class SitemapController extends Controller
{

    public function actionIndex()
    {                
        $products = \app\models\Products::find()->all();
        //var_dump($products);
        
//        $xml=new DomDocument('1.0','utf-8');
//        $sorts = $xml->appendChild($xml->createElement('sorts'));
//        $sort = $sorts->appendChild($xml->createElement('sort'));
//        $name = $sort->appendChild($xml->createElement('name'));
//        $name->appendChild($xml->createTextNode('Яблоко'));
//        $xml->formatOutput = true;
//        $xml->save('goods.xml');
        //<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        
        $xml=new DOMDocument('1.0','utf-8');        
        $urlset = $xml->appendChild(new \DOMElement("urlset"));        
        foreach ($products as $prod)
        {            
            //$sitemap = simplexml_load_file("sitemap.xml");            
            $url = $urlset->appendChild(new \DOMElement("url"));
            $url->appendChild(new \DOMElement("loc","http://c-fashion.ru/site/productpage?id_product=".$prod['id_product']));
            $url->appendChild(new \DOMElement("changefreq", "weekly"));
            $url->appendChild(new \DOMElement("priority", "0.50"));
        }
        //var_dump($prodid);
        $xml->formatOutput = true;
        $xml->save('sitemap.xml');
        //$dom = new DOMDocument('1.0',LIBXML_NOBLANKS);
        //$dom->formatOutput = true;
        //$dom->loadXML($sitemap->asXML());
        //$dom->saveXML('sitemap.xml');
    }
    
}
