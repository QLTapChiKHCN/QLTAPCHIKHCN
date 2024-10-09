
      var app = angular.module("myApp", ["ngRoute"]);
      app.config(function ($routeProvider) {
        $routeProvider
          .when("/home", { templateUrl: "/layout/data_index.html" })
          .when("/login", { templateUrl: "/layout/login.html" })
          .when("/signup", { templateUrl: "/layout/SignUp.html" })
          .when("/quanlykinhke", {
            templateUrl: "/layout/data_quanlykinhte.html",
          })
          .when("/post", {
            templateUrl: "/layout/post.html",
            controller: "PostController",
          })
          
          .otherwise({
            templateUrl: "/layout/data_index.html",
          });
      });
      app.controller("myCtrl", function ($scope, $http) {
        $scope.list_index = [];
        $scope.list_bao = [];
        $http.get("/js/data_index.json").then(
          function (d) {
            $scope.list_index = d.data;
          },
          function (e) {
            console.log(e.message);
          }
        );
        $http.get("/js/data_quanlykinhte.json").then(
          function (d) {
            $scope.list_bao = d.data;
          },
          function (e) {
            console.log(e.message);
          }
        );
      });
      app.controller("PostController", function ($scope) {
          new FroalaEditor('#editor')
          new FroalaEditor('#editorEN')
          new FroalaEditor('#tailieuthamkhao')
      });
   