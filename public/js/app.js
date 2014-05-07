'use strict';

angular.module('GigyaUtilsApp', [
        'GigyaUtilsApp.controllers'
    ])
    .config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('//');
        $interpolateProvider.endSymbol('//');
    });

angular.module('GigyaUtilsApp.controllers', [])
    .controller('FeedCtrl', function ($scope, $http) {
        $scope.isConnected = false;
        $scope.feedType = 'text';

        $scope.getFeed = function (feedType) {
            $http.get(GU.root + '/sandbox/getFeed').then(function (result) {
                $scope.feedType = feedType;
                $scope.feed = result.data; // ALL FEED DATA
                //$scope.feedItems = $scope.feed.everyone.items;
                $scope.feedItems = [];
                $scope.feed.everyone.items.forEach(function (item) {
                    var tags = item.action.actionData1.split(',');
                    tags.forEach(function (tag) {
                        if (tag == $scope.feedType) {
                            $scope.feedItems.push(item);
                        }
                    });
                });
            });
        };

        /* click actions */
        $scope.logout = function () {
            gigya.socialize.logout({
                callback: function (response) {
                    console.log(response);
                    $scope.isConnected = false;
                    $scope.$apply();
                }
            });
        };

        /* --- initialize gigya plugins --- */
        // login plugin
        gigya.socialize.showLoginUI({
            containerID: 'gig-login',
            onLogin: function () {
                $scope.isConnected = true;
                $scope.$apply();
            }
        });

        // get logged in status
        gigya.socialize.getUserInfo({
            callback: function (response) {
                $scope.isConnected = !!(response.user.UID);
                $scope.username = response.user.firstName + ' ' + response.user.lastName;
                $scope.$apply();
            }
        });

        $scope.getFeed($scope.feedType);
    });