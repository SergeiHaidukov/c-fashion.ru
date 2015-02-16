'use strict';

app.factory('CategoriesService'
    ,['$http', '$rootScope', '$location'
    ,function($http, $rootScope, $location){
        var categories = [];//все категории
        var catprod = [];//категории к которым принадлежит продукт
        var colors = [];//все цвета
        var colprod = [];//все цвета для товара
        var sizes = [];//все размеры
        var sizeprod = [];//все размеры для товара
        
        var service = {};
//-----------------------------------------------------------------------------------------------------------                        
// получает данные из get запроса
        var tmp = new Array();		// два вспомагательных
        var tmp2 = new Array();		// массива
        var param = new Array();

        var get = location.search;	// строка GET запроса
        if(get != '') {
                tmp = (get.substr(1)).split('&');	// разделяем переменные
                for(var i=0; i < tmp.length; i++) {
                        tmp2 = tmp[i].split('=');		// массив param будет содержать
                        param[tmp2[0]] = tmp2[1];		// пары ключ(имя переменной)->значение
                }                
        }
//-----------------------------------------------------------------------------------------------------------        
        var id_product = param['id'];//id товара
        
        service.getIdProduct = function(){//возвращает id товара
            return id_product;
        }                        
//-----------------------------------------------------------------------------------------------------------                
//Асинхронные запросы для категорий
        function getAll() {//получает все категории
//            var host = $location.host();
//            var port = $location.port();
//            var url = $location.protocol() + '://'+host+':'+port+'/products/list';            
        $http.get('/api/categories')

            .success(function(data, status, headers, config) {

                categories = data;                
                
                $rootScope.$broadcast('categories:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        function getCategoryProduct() {//получает все категории для товара
        $http.get('/api/categoriesproducts/getcategoriesproduct?id_product='+id_product)

            .success(function(data, status, headers, config) {

                catprod = data;

                $rootScope.$broadcast('catprod:updated');
                console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});
        }
        
        service.setCategoryProduct = function (id_category) {//устанавливает соответсвие категория продукт
            
        $http.post('/api/categoriesproducts',{id_category:id_category, id_product:id_product})

            .success(function(data, status, headers, config) {               
                
                $rootScope.$broadcast('catprod:updated');
                getCategoryProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }
        
        service.delCategoryProduct = function (id_cat_prod) {//удаляет соответствие категории продукту
            
        $http.delete('/api/categoriesproducts/'+id_cat_prod)

            .success(function(data, status, headers, config) {
                
                $rootScope.$broadcast('catprod:updated');
                getCategoryProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }
//-----------------------------------------------------------------------------------------------------------                                
//-----------------------------------------------------------------------------------------------------------        
//Асинхронные запросы для цвета        
        function getAllColors() {//получает все цвета

        $http.get('/api/colors')

            .success(function(data, status, headers, config) {

                colors = data;                
                
                $rootScope.$broadcast('colors:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        function getColorsProduct() {//получает все цвета для товара
        $http.get('/api/colorsproducts/getcolorsproduct?id_product='+id_product)

            .success(function(data, status, headers, config) {

                colprod = data;

                $rootScope.$broadcast('colprod:updated');
                console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});
        }
        
        service.setColorProduct = function (id_color) {//устанавливает соответсвие цвет продукт
            
        $http.post('/api/colorsproducts',{id_color:id_color, id_product:id_product})

            .success(function(data, status, headers, config) {               
                
                $rootScope.$broadcast('colprod:updated');
                getColorsProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }
        
        service.delColorProduct = function (id_col_prod) {//удаляет соответствие цвет продукт
            
        $http.delete('/api/colorsproducts/'+id_col_prod)

            .success(function(data, status, headers, config) {
                
                $rootScope.$broadcast('colprod:updated');
                getColorsProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }
//-----------------------------------------------------------------------------------------------------------                
//-----------------------------------------------------------------------------------------------------------        
//Асинхронные запросы для размера
        function getAllSizes() {//получает все размеры

        $http.get('/api/sizes')

            .success(function(data, status, headers, config) {

                sizes = data;                
                
                $rootScope.$broadcast('sizes:updated');
                //console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});                        
        }
        
        function getSizesProduct() {//получает все размеры для товара
        $http.get('/api/sizesproducts/getsizesproduct?id_product='+id_product)

            .success(function(data, status, headers, config) {

                sizeprod = data;

                $rootScope.$broadcast('sizeprod:updated');
                console.log(data);                
            })

            .error(function(data, status, headers, config) { console.log(data);});
        }
        
        service.setSizeProduct = function (id_size) {//устанавливает соответсвие цвет продукт
            
        $http.post('/api/sizesproducts',{id_size:id_size, id_product:id_product})

            .success(function(data, status, headers, config) {               
                
                $rootScope.$broadcast('sizeprod:updated');
                getSizesProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }
        
        service.delSizeProduct = function (id_size_prod) {//удаляет соответствие цвет продукт
            
        $http.delete('/api/sizesproducts/'+id_size_prod)

            .success(function(data, status, headers, config) {
                
                $rootScope.$broadcast('sizeprod:updated');
                getSizesProduct();
                console.log(data);
            })
            .error(function(data, status, headers, config) { console.log(data); });
        }        
//-----------------------------------------------------------------------------------------------------------        
        
        getCategoryProduct();
        getAll();
        getColorsProduct();
        getAllColors();
        getSizesProduct();
        getAllSizes();
        
        service.getAll = function(){//возвращает все категории
            
            var categories_tmp = [];
                angular.forEach(categories, function(cat){
                    var cat_in_cp = false;
                    angular.forEach(catprod, function(cp){
                        if(parseInt(cat.id_category, 10) == parseInt(cp.id_category, 10)){
                            cat_in_cp = true;
                        }
                    });
                    if (!cat_in_cp){
                        categories_tmp.push(cat);
                    }
                });            
            
            return categories_tmp;
        }
        
        service.getCategoryProduct = function(){//возвращает категории для товара                 
            return catprod;
        }
        
        service.getAllColors = function(){//возвращает все цвета
            
            var colors_tmp = [];
                angular.forEach(colors, function(col){
                    var col_in_cp = false;
                    angular.forEach(colprod, function(cp){
                        if(parseInt(col.id_color, 10) == parseInt(cp.id_color, 10)){
                            col_in_cp = true;
                        }
                    });
                    if (!col_in_cp){
                        colors_tmp.push(col);
                    }
                });            
            
            return colors_tmp;
        }
        
        service.getColorsProduct = function(){//возвращает цвета для товара                 
            return colprod;
        }
        
        service.getAllSizes = function(){//возвращает все размеры            
            var sizes_tmp = [];
                angular.forEach(sizes, function(sz){
                    var sz_in_sp = false;
                    angular.forEach(sizeprod, function(sp){
                        if(parseInt(sz.id_size, 10) == parseInt(sp.id_size, 10)){
                            sz_in_sp = true;
                        }
                    });
                    if (!sz_in_sp){
                        sizes_tmp.push(sz);
                    }
                });            
            
            return sizes_tmp;
        }
        
        service.getSizesProduct = function(){//возвращает размеры для товара                 
            return sizeprod;
        }
        
        return service;
    }])