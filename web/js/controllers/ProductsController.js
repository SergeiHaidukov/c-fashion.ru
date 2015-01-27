'use strict';

app.controller('ProductsController'
    ,['$scope', '$rootScope', 'ProductsService', '$routeParams', '$location', '$sce',
    function($scope, $rootScope, ProductsService, $routeParams, $location, $sce){
        
        $scope.test = '1';  
        
        $scope.sce = $sce;
        
        $scope.go = function ( path ) {
          $location.path( path );
        };
        
        // Retrieving a cookie
        //$scope.categories_filter = $cookies.categories_filter;
        // Setting a cookie
        //$cookies.myFavorite = '123';
        //$scope.favoriteCookie = $cookies.myFavorite;
        
        //console.log($cookies.categories_filter);
        
        $rootScope.price = 10000;
        $rootScope.minPrice = 1200;
        $rootScope.maxPrice = 20000;
        
        $rootScope.$on('products_filter:updated', function(event, data) {
            $rootScope.products = ProductsService.getAllMiniature();            
        });        
        
        $rootScope.$on('products:updated', function(event, data) {
            $rootScope.products = ProductsService.getAllMiniature();            
//            var priceArray = ProductsService.getProductsPrice();            
//            $rootScope.maxPrice = Math.max.apply({},priceArray);
//            $rootScope.minPrice = Math.min.apply({},priceArray);            
        });        
        
        $rootScope.$on('categories:updated', function(event, data) {
            $rootScope.categories = ProductsService.getAllCategories();
        });
        
        $rootScope.$on('sizes:updated', function(event, data) {
            $rootScope.sizes = ProductsService.getAllSizes();
        });
        
        $rootScope.$on('colors:updated', function(event, data) {
            $rootScope.colors = ProductsService.getAllColors();            
        });
        
        $scope.setfiltercatprod = function(id_category) {
            ProductsService.setFilterCatProd(id_category);
        }            
        
        $scope.delfiltercatprod = function(id_category) {
            ProductsService.delFilterCatProd(id_category);
        }
        
        $scope.setfiltersizeprod = function(id_size) {
            ProductsService.setFilterSizeProd(id_size);
        }            
        
        $scope.delfiltersizeprod = function(id_size) {
            ProductsService.delFilterSizeProd(id_size);
        }
        
        $scope.setfiltercolorprod = function(id_color) {
            ProductsService.setFilterColorProd(id_color);
        }            
        
        $scope.delfiltercolorprod = function(id_color) {
            ProductsService.delFilterColorProd(id_color);
        }
        
        //$cookies.categories_filter = $scope.categories_filter;        
        
        $rootScope.$on('products_filter:updated', function(event, data) {
            $rootScope.categories_filter = ProductsService.getFiltercatprod();
            $rootScope.sizes_filter = ProductsService.getFiltersizeprod();
            $rootScope.colors_filter = ProductsService.getFiltercolorprod();
            $rootScope.categories = ProductsService.getAllCategories();                        
            
            //$cookies.categories_filter = $scope.categories_filter;
        }); 
        
        $rootScope.$on('single_product_images:updated', function(event, data) {
            $scope.single_product_images = ProductsService.getProductPictures();//миниатюры для товара
            $scope.single_product_image_main = ProductsService.setMainPictures('-1');//устанавливаем клавную картинку
        });
        
        $rootScope.$on('single_product:updated', function(event, data) {
            $scope.single_product = ProductsService.getProduct();//детальная информация о товаре
        });
        
        $scope.setmainpictures = function(id_picture){
            ProductsService.setMainPictures(id_picture);//устанавливаем главную картинку
            $scope.single_product_image_main = ProductsService.getMainPictures();
        }
        
        if ($routeParams.id_product !== undefined)
        {
            //$scope.viewproduct = ProductsService.viewProduct($routeParams.id_product);
            $scope.id_product = $routeParams.id_product;
            ProductsService.setProductPictures($scope.id_product);
            ProductsService.setProduct($scope.id_product);
        }
        
    }])