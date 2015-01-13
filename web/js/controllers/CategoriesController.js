'use strict';

app.controller('CategoriesController'
    ,['$scope', '$rootScope', 'CategoriesService',
    function($scope, $rootScope, CategoriesService){                                
 
        $rootScope.$on('categories:updated', function(event, data) {
            $scope.categories = CategoriesService.getAll();            
        });
        
        $rootScope.$on('catprod:updated', function(event, data) {
            $scope.catprod = CategoriesService.getCategoryProduct();            
            $scope.categories = CategoriesService.getAll();
            //console.log($scope.id_catprod_array);
            
        });                
        
        $scope.setcatprod = function(catprod){
            CategoriesService.setCategoryProduct(catprod);
        }
        
        $scope.delcatprod = function(catprod){
            CategoriesService.delCategoryProduct(catprod);
        }
        
        $rootScope.$on('colors:updated', function(event, data) {
            $scope.colors = CategoriesService.getAllColors();            
        });
        
        $rootScope.$on('colprod:updated', function(event, data) {
            $scope.colprod = CategoriesService.getColorsProduct();            
            $scope.colors = CategoriesService.getAllColors();
            //console.log($scope.id_catprod_array);
            
        });
        
        $scope.setcolprod = function(colprod){
            CategoriesService.setColorProduct(colprod);
        }
        
        $scope.delcolprod = function(colprod){
            CategoriesService.delColorProduct(colprod);
        }
        
        $rootScope.$on('sizes:updated', function(event, data) {
            $scope.sizes = CategoriesService.getAllSizes();
        });
        
        $rootScope.$on('sizeprod:updated', function(event, data) {
            $scope.sizeprod = CategoriesService.getSizesProduct();
            $scope.sizes = CategoriesService.getAllSizes();
            //console.log($scope.id_catprod_array);
            
        });
        
        $scope.setsizeprod = function(sizeprod){
            CategoriesService.setSizeProduct(sizeprod);
        }
        
        $scope.delsizeprod = function(sizeprod){
            CategoriesService.delSizeProduct(sizeprod);
        }
       
       
        //$scope.id_product = CategoriesService.getIdProduct();
        
        
        
    }])