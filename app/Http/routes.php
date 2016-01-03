<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


/**
 * 接口routes
 */
Route::group(['domain' => 'api.strever.dev', 'namespace' => 'Api', 'middleware' => ['api']], function () {

    Route::get('/', function() {
        return 'welcome!';
    });

    //申请 access_token 或者刷新 access_token.
    Route::any('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });


    /*
    //此分组下路由 需要通过 login-token 方式认证的 access token
    Route::group(['middleware' => 'oauth2:user'], function () {
        // 发布内容单独设置频率限制
        Route::group([
            'middleware' => 'api.throttle',
            'limit' => config('api.rate_limits.publish.limits'),
            'expires' => config('api.rate_limits.publish.expires'),
        ], function ($router) {
            Route::post('topics', 'TopicsController@store');
            Route::post('replies', 'RepliesController@store');
        });
        Route::group([
            'middleware' => 'api.throttle',
            'limit' => config('api.rate_limits.access.limits'),
            'expires' => config('api.rate_limits.access.expires'),
        ], function ($router) {
            // Users
            Route::get('me', 'UsersController@me');
            Route::put('users/{id}', 'UsersController@update');
            // Topics
            Route::delete('topics/{id}', 'TopicsController@delete');
            Route::post('topics/{id}/vote-up', 'TopicsController@voteUp');
            Route::post('topics/{id}/vote-down', 'TopicsController@voteDown');
            // Topics 收藏
            Route::post('topics/{id}/favorite', 'TopicsController@favorite');
            Route::delete('topics/{id}/favorite', 'TopicsController@unFavorite');
            // Topics 关注
            Route::post('topics/{id}/attention', 'TopicsController@attention');
            Route::delete('topics/{id}/attention', 'TopicsController@unAttention');
            // Notifications
            Route::get('me/notifications', 'NotificationController@index');
            Route::get('me/notifications/count', 'NotificationController@unreadMessagesCount');
        });
    });


    //此分组下路由 同时支持两种认证方式获取的 access_token
    Route::group([
        'middleware' => ['oauth2', 'api.throttle'],
        'limit' => config('api.rate_limits.access.limits'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function () {
        Route::get('topics/{id}', 'TopicsController@show');
        //Topics
        Route::get('topics', 'TopicsController@index');
        Route::get('user/{id}/favorite/topics', 'TopicsController@indexByUserFavorite');
        Route::get('user/{id}/attention/topics', 'TopicsController@indexByUserAttention');
        Route::get('user/{id}/topics', 'TopicsController@indexByUserId');
        Route::get('node/{id}/topics', 'TopicsController@indexByNodeId');
        //Web Views
        Route::get('topics/{id}/web_view',
            ['as' => 'topic.web_view', 'uses' => 'TopicsController@showWebView']);
        Route::get('topics/{id}/replies/web_view',
            ['as' => 'replies.web_view', 'uses' => 'RepliesController@indexWebViewByTopic']);
        Route::get('users/{id}/replies/web_view',
            ['as' => 'users.replies.web_view', 'uses' => 'RepliesController@indexWebViewByUser']);
        //Nodes
        Route::get('nodes', 'NodesController@index');
        //Replies
        Route::get('topics/{id}/replies', 'RepliesController@indexByTopicId');
        Route::get('users/{id}/replies', 'RepliesController@indexByUserId');
        //Users
        Route::get('users/{id}', 'UsersController@show');
        //Adverts
        Route::get('adverts/launch_screen', 'LaunchScreenAdvertsController@index');
    });*/
});


/**
 * 后台路由
 */
Route::group(['domain' => 'admin.strever.dev', 'namespace' => 'Admin'], function () {
    Route::get('/', function() {
        return view('welcome');
        abort(404);
    });
});

/**
 * web 路由
 */
Route::group(['middleware' => ['web']], function () {

    Route::get('/', function() {
        return redirect('/article/');
    });

    Route::get('/article', 'Blog@index');

    Route::get('/article/{id}', function($id) {
        return \App\Article::findOrFail(['slug' => $id]);
    });

    Route::get('/detail/{slug}', 'Blog@detail');

    Route::get('/about', function() {
        return config('blog.site_title');
    });

    Route::get('/tag/{id}', function($id) {
        return 'dfvffg';
    });

    Route::get('/test', function() {
        return 'dfgjbfjhvbfvbhdfjlkslkjg';
    });
});
