'use strict';

app.factory('ProductsService'
    ,['$http', '$rootScope', '$location'
    ,function($http, $rootScope, $location){
        var products = [];
        //var products_price = [];//цена продуктов в отдельном массиве, для расчета минимальной и максимальной цены
        var products_filter = [];
        var categories = [];
        var categories_filter = [];
        var sizes = [];
        var sizes_filter = [];
        var colors = [];
        var colors_filter = [];
        var single_product;
        var single_product_images = [];
        var single_product_sizes = [];
        var single_product_colors = [];
        var single_product_main_picture;
        var price = 10000;
        var price_min = 1000;
        var price_max = 100000;

        function getAllMiniature() {
//            var host = $location.host();
//            var port = $location.port();
//            var url = $location.protocol() + '://'+host+':'+port+'/products/list';            
            $http.get('/api/products/getminiature')

                .success(function(data, status, headers, config) {

                    products = data;

                    $rootScope.$broadcast('products:updated');
                    console.log(data);
                })

                .error(function(data, status, headers, config) {console.log(data);});
        }
        
        var service = {};
        
//-----------------------------------------------------------------------------------------------------------
//Запросы для цены price
   service.getPrice = function(){
       return price;
   } 
   service.getPriceMin = function(){
       return price_min;
   } 
   service.getPriceMax = function(){
       return price_max;
   } 
   
   service.setPrice = function(last_price){
       price = last_price;
       console.log(price);
   } 
//-----------------------------------------------------------------------------------------------------------        
//-----------------------------------------------------------------------------------------------------------                        
//Запросы для одного товара

    service.setProduct = function(id_product){
        $http.get('/api/products/'+id_product)

                .success(function(data, status, headers, config) {
                    single_product = data;
                    $rootScope.$broadcast('single_product:updated');
                    console.log(data);                    
                })

        .error(function(data, status, headers, config) {console.log(data);});
    }
    
    service.getProduct = function(){
        return single_product;
    }
        
    //Запросы для изображений
    service.setProductPictures = function(id_product) {//устанавливает изображения для товара по id товара
            $http.get('/api/products/getproductpictures?id_product='+id_product)

                .success(function(data, status, headers, config) {
                    single_product_images = data;
                    $rootScope.$broadcast('single_product_images:updated');                    
                    console.log(data);                    
                })

                .error(function(data, status, headers, config) {console.log(data);});
        }
    service.setMainPictures = function (id_picture){//устанавливает главную картинку по id изображения
            if(id_picture === '-1') return single_product_images[0];
            angular.forEach(single_product_images, function(spi){
               if(spi.id_picture === id_picture){                   
                    single_product_main_picture = spi;
               }
               
            });
        }
    service.getMainPictures = function (){//возвращает миниатюры для товара
           return single_product_main_picture;
        }        
    service.getProductPictures = function (){//возвращает главную картинку для товара
           return single_product_images;
        }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Запросы для размеров
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
        
//-----------------------------------------------------------------------------------------------------------                                
//-----------------------------------------------------------------------------------------------------------                                        
        
        getAllMiniature();
        
        function getFilteredProducts(){//получаем массив товаров после фильтрации по всем товарам
            var filtered_products = [];//массив товаров после фильтрации по всем параметрам
            if(categories_filter.length > 0)//выбираем только товары относящиеся к выбранным категориям
            {
                angular.forEach(products_filter, function(pf){
                    angular.forEach(categories_filter, function(cf){
                        if(parseInt(pf.id_category, 10) === parseInt(cf.id_category, 10)){
                            filtered_products.push(pf);
                            //console.log(pf);
                        }
                    });                
                });
            }
            else {filtered_products = products_filter;}//если нет выбранных категорий
            
            if(sizes_filter.length > 0)//фильтр по размеру
            {
                var filtered_products_tmp = [];
                angular.forEach(filtered_products, function(fp){
                    angular.forEach(sizes_filter, function(sf){
                        if(parseInt(fp.id_size, 10) === parseInt(sf.id_size, 10)){
                            filtered_products_tmp.push(fp);
                            //console.log(fp);
                        }
                    });                
                });
                filtered_products = filtered_products_tmp;
            }
            else {}
            
            if(colors_filter.length > 0)//фильта по цвету
            {
                var filtered_products_tmp = [];
                angular.forEach(filtered_products, function(fp){
                    angular.forEach(colors_filter, function(sf){
                        if(parseInt(fp.id_color, 10) === parseInt(sf.id_color, 10)){
                            filtered_products_tmp.push(fp);
                            //console.log(fp);
                        }
                    });                
                });
                filtered_products = filtered_products_tmp;
            }
            else {}
            
            //console.log(filtered_products);
            return filtered_products;
        }
        
        service.getAllMiniature = function()//получаем все товары которые есть в отфильтрованном массиве и в 
                                                //начальном массиве товаров с миниатюрами
        {
            var filtered_products = getFilteredProducts();//отфильтрованный по всем параметрам массив товаров
            //if (filtered_products.length === 0){filtered_products = products_filter;}
            var prod_tmp = [];
                angular.forEach(products, function(p){
                    var p_in_pf = false;
                    angular.forEach(filtered_products, function(pf){
                        if(parseInt(p.id_product, 10) == parseInt(pf.id_product, 10)){
                            p_in_pf = true;
                        }
                    });
                    if (p_in_pf){
                        prod_tmp.push(p);
                    }
            });
            
//            var tempArray = [];
//            angular.forEach(products, function(p){
//                tempArray.push(parseInt(p.price, 10));
//                });
//            products_price = tempArray;
            return prod_tmp;            
        }        
//        service.getProductsPrice = function()
//        {
//            return products_price;
//        }
        service.setPriceMinMax = function(){
            var filtered_products = products;//getFilteredProducts();
            var minPrice = 100000;
            var maxPrice = 1000;
            angular.forEach(filtered_products, function(fp){
                        if(fp.price < minPrice){
                            minPrice = parseInt(fp.price, 10);
                        }
                        if(fp.price > maxPrice){
                            maxPrice = parseInt(fp.price, 10);
                        }
                    });
            if (price < parseInt(minPrice, 10)){price = parseInt(minPrice, 10);}
            if (price > parseInt(maxPrice, 10)){price = parseInt(maxPrice, 10);}            
            console.log(price);
            price_min = minPrice;
            price_max = maxPrice;            
        }
//-----------------------------------------------------------------------------------------------------------                
//Запросы для категорий
        function getAllCategories() {//получает все категории
//            var host = $location.host();
//            var port = $location.port();
//            var url = $location.protocol() + '://'+host+':'+port+'/products/list';            
        $http.get('/api/categoriesproducts/getcategoriesproducts')

            .success(function(data, status, headers, config) {

                categories = data;
                //console.log(categories);
                $rootScope.$broadcast('categories:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        getAllCategories();
        
        service.getAllCategories = function (){
           return categories;
        }
        
        service.setFilterCatProd = function(id_category) {
            var index = 0;
            angular.forEach(categories, function(c){                                
                if(c.id_category === id_category)
                {                    
                    categories_filter.push(c);
                    categories.splice(index, 1);
                }
                index++;
                });
            //console.log(categories_filter);    
            $rootScope.$broadcast('products_filter:updated');            
        }
        
        service.delFilterCatProd = function(id_category) {
            var index = 0;
            angular.forEach(categories_filter, function(cf){                                
                if(cf.id_category === id_category)
                {                    
                    categories.push(cf);
                    categories_filter.splice(index, 1);
                }
                index++;
                });
            $rootScope.$broadcast('products_filter:updated');    
            //console.log(categories_filter);
        }
        
        service.getFiltercatprod = function (){
           return categories_filter;
        }
        
//-----------------------------------------------------------------------------------------------------------                        
//-----------------------------------------------------------------------------------------------------------                        
//Запросы для размера
        
        function getAllSizes() {//получает все размеры

        $http.get('/api/sizesproducts/getsizesproducts')

            .success(function(data, status, headers, config) {

                sizes = data;                
                
                $rootScope.$broadcast('sizes:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        getAllSizes();
        
        service.getAllSizes = function (){
           return sizes;
        }
        
        service.setFilterSizeProd = function(id_size) {
            var index = 0;
            angular.forEach(sizes, function(c){                                
                if(c.id_size === id_size)
                {                    
                    sizes_filter.push(c);
                    sizes.splice(index, 1);
                }
                index++;
                });
            //console.log(sizes_filter);
            $rootScope.$broadcast('products_filter:updated');            
        }
        
        service.delFilterSizeProd = function(id_size) {
            var index = 0;
            angular.forEach(sizes_filter, function(cf){                                
                if(cf.id_size === id_size)
                {                    
                    sizes.push(cf);
                    sizes_filter.splice(index, 1);
                }
                index++;
                });
            $rootScope.$broadcast('products_filter:updated');
            console.log(sizes_filter);
        }
        
        service.getFiltersizeprod = function (){
           return sizes_filter;
        }
        
//-----------------------------------------------------------------------------------------------------------                        
//Запросы для цвета
        
        function getAllColors() {//получает все цвета

        $http.get('/api/colorsproducts/getcolorsproducts')

            .success(function(data, status, headers, config) {

                colors = data;                
                
                $rootScope.$broadcast('colors:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        getAllColors();
        
        service.getAllColors = function (){
           return colors;
        }
        
        service.setFilterColorProd = function(id_color) {
            var index = 0;
            angular.forEach(colors, function(c){
                if(c.id_color === id_color)
                {                    
                    colors_filter.push(c);
                    colors.splice(index, 1);
                }
                index++;
                });
            console.log(colors_filter);
            $rootScope.$broadcast('products_filter:updated');            
        }
        
        service.delFilterColorProd = function(id_color) {
            var index = 0;
            angular.forEach(colors_filter, function(cf){                                
                if(cf.id_color === id_color)
                {                    
                    colors.push(cf);
                    colors_filter.splice(index, 1);
                }
                index++;
                });
            $rootScope.$broadcast('products_filter:updated');
            console.log(colors_filter);
        }
        
        service.getFiltercolorprod = function (){
           return colors_filter;
        }

//-----------------------------------------------------------------------------------------------------------                        
//-----------------------------------------------------------------------------------------------------------                
//Запросы для изображений
        service.viewProduct = function(id_product) {//получает все связанные с продуктами данные о размере, цене, цвете, категории
            //основной массив для фильтрации выдачи
//            var host = $location.host();
//            var port = $location.port();
//            var url = $location.protocol() + '://'+host+':'+port+'/products/list';            
        $http.get('/site/productpage?id_product='+id_product)

            .success(function(data, status, headers, config) {

                //product_page = data;
                $rootScope.$broadcast('product_page:updated');                
                console.log(data);                
                return data;
            })

            .error(function(data, status, headers, config) {console.log(data);});
        }
//-----------------------------------------------------------------------------------------------------------                        
//-----------------------------------------------------------------------------------------------------------                        

        function getProductsFilter() {//получает все связанные с продуктами данные о размере, цене, цвете, категории
            //основной массив для фильтрации выдачи
//            var host = $location.host();
//            var port = $location.port();
//            var url = $location.protocol() + '://'+host+':'+port+'/products/list';            
        $http.get('/api/products/getproductsfilter')

            .success(function(data, status, headers, config) {

                products_filter = data;
                $rootScope.$broadcast('products_filter:updated');
                //console.log(data);
            })

            .error(function(data, status, headers, config) {console.log(data);});
        }                               
                
        getProductsFilter();                   
        
        return service;
    }])