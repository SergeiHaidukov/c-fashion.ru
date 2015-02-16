'use strict';

app.controller('ProductsController'
    ,['$scope', '$rootScope', 'ProductsService', '$routeParams', '$location', '$sce', '$anchorScroll', '$timeout',
    function($scope, $rootScope, ProductsService, $routeParams, $location, $sce , $anchorScroll, $timeout){        
        $location.hash("product_"+$rootScope.id_product);
        $scope.test = '1';  
        
        $scope.sce = $sce;
        
        $scope.go = function (path) {          
          $location.path(path);
          for(var i=0; i<=3; i++) $timeout($scope.goToAnchor, 1000);
          
        };
        
        $scope.goToAnchor = function() {
          //$location.hash("product_"+24);
          $location.hash("product_"+$rootScope.id_product);
          console.log($location.hash());
          $anchorScroll();
        };                
        
        $scope.fixPrice = function (last_price) {
          ProductsService.setPrice(last_price);
          $rootScope.price = ProductsService.getPrice();          
        };
        
        // Retrieving a cookie
        //$scope.categories_filter = $cookies.categories_filter;
        // Setting a cookie
        //$cookies.myFavorite = '123';
        //$scope.favoriteCookie = $cookies.myFavorite;
        
        //console.log($cookies.categories_filter);
        
        $rootScope.price = ProductsService.getPrice();
        $rootScope.minPrice = ProductsService.getPriceMin();
        $rootScope.maxPrice = ProductsService.getPriceMax();
        
        $rootScope.$on('products_filter:updated', function(event, data) {
            $rootScope.products = ProductsService.getAllMiniature();            
            ProductsService.setPriceMinMax();
            $rootScope.price = ProductsService.getPrice();
            $rootScope.minPrice = ProductsService.getPriceMin();
            $rootScope.maxPrice = ProductsService.getPriceMax();            
            console.log("::products_filter::update");
        });        
        
        $rootScope.$on('products:updated', function(event, data) {
            $rootScope.products = ProductsService.getAllMiniature();                        
            ProductsService.setPriceMinMax();            
            $rootScope.price = ProductsService.getPrice();
            $rootScope.minPrice = ProductsService.getPriceMin();
            $rootScope.maxPrice = ProductsService.getPriceMax();
            console.log("::products::update");
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
        
//        $rootScope.$on("init", function(ev, data) {
//            console.log("::use::init");
//        });
        
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
            $rootScope.id_product = $routeParams.id_product;
            $location.hash("product_"+$rootScope.id_product);
            ProductsService.setProductPictures($rootScope.id_product);
            ProductsService.setProduct($rootScope.id_product);
        }
        
        console.log("::use::ctrl");          
    }])