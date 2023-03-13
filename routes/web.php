<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!".env('DB_DATABASE');
});
Route::post('/eversign-api', 'Web\PortfolioController@eversignApi');
Route::get('/send-survey-results', 'CronController@surveyResults');
//register web and socail login routes
Route::get('/stripePaymentForm', 'StripeController@stripePaymentForm');
Route::get('/paymentForm', 'StripeController@StripePayment');
Route::post('/webLoginPost', 'Auth\LoginController@webLoginPost');
Route::post('/socialLoginPayment', 'StripeController@socialLoginPayment');
Route::post('/stripeStore', 'StripeController@stripeStore');
Route::post('/getStartedStripeStore', 'StripeController@getStartedStripeStore');
Route::post('/socialStripeStore', 'StripeController@socialStripeStore');
Route::post('/stripeUpdate', 'StripeController@stripeUpdate');
Route::get('downloadStripeInvoice/{userId}/{invoiceId}/{productName}/{inv_no}','StripeController@downloadStripeInvoice');
Route::get('/user/verify/{token}', 'Member\RegisterController@verifyUser');
Route::post('/zeroPlanPrice', 'Member\RegisterController@zeroPlanPrice')->name('zeroPlanPrice');
Route::post('forgot/password', 'Auth\ForgotPasswordController@forgot_password')->name('forgot.password');
Auth::routes();
Auth::routes(['verify' => true]);
Route::post('facebookStore', 'FacebookController@facebookStore')->name('facebookStore');
Route::get('/callback', 'FacebookController@callback');
Route::post('googleStore','GoogleController@googleStore')->name('googleStore');
Route::post('zeroPricePlanSocialLogin','GoogleController@zeroPricePlanSocialLogin')->name('zeroPricePlanSocialLogin');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');


Route::get('/', 'Web\HomeController@index')->name('landing-page');
Route::get('/home', 'Web\HomeController@index')->name('home');
Route::get('faqs','Web\HomeController@faqs')->name('faqs');
Route::get('company','Web\HomeController@company')->name('faqs');
Route::resource('pages','Web\PageController');
Route::resource('profiles','Web\ProfileController');
Route::post('changePassword/{id}','Web\ProfileController@changePassword');

// Route::get('/transaction-hisotry','Web\HistoricalOwnershipController@index');
Route::match(['get', 'post'], '/transaction-hisotry','Web\HistoricalOwnershipController@index');




Route::get('unsubscribe', 'Web\ProfileController@unsubscribe')->name('unsubscribe');
Route::post('accountDeleteRequest', 'Web\ProfileController@accountDeleteRequest')->name('accountDeleteRequest');

Route::get('admin/login', 'Auth\LoginController@index');

Route::post('storeMember', 'Member\RegisterController@store')->name('storeMember');
/*Route::get('admin/newventurelisting', function (){
        return view('admin.layouts.pages.newVentures.newVentures');
    });*/

    Route::get('admin/currentventurelisting', function (){
        return view('admin.layouts.pages.currentVenturesListing.currentVenturesListing');
    });
    Route::get('admin/currentventurelisting/create', function (){
        return view('admin.layouts.pages.currentVenturesListing.create');
    });
    Route::resource('new-venture-listings','Web\NewVentureController');
    Route::resource('current-venture-listings','Web\CurrentVentureController');

    Route::group([ 'middleware' =>['role:user'] ], function (){

        Route::get('/communication','Web\MemberCommunicationController@index');
        Route::get('/communication/show/{id}','Web\MemberCommunicationController@show');
        Route::post('/user/communication/reply','Web\MemberCommunicationController@reply');
        Route::post('/user/communication-vo/store','Web\MemberCommunicationController@storeCommunicationVO');
        Route::post('/user/communicationSearch','Web\MemberCommunicationController@communicationSearch');

        Route::get('/survey','Web\SurveyController@index');
        Route::post('/user/surveySearch','Web\SurveyController@surveySearch');
        Route::get('/user/survey/show/{surveyId}','Web\SurveyController@show');
        Route::post('/user/survey/store/','Web\SurveyController@store');




        Route::post('/user/communication-vpm/store','Web\MemberCommunicationController@storeCommunicationVPM');
        Route::post('/communication/bulk-delete','Web\MemberCommunicationController@bulkDestroy');

    //venture list Search
        Route::get('dashboard','Web\MemberDashboardController@index');
        Route::post('ventureSearch','Web\NewVentureController@ventureSearch');

        Route::post('ventureCommit','Web\NewVentureController@ventureCommit');
        Route::post('cancelCommit','Web\NewVentureController@cancelCommit');    
    //new venture routes
        
    //    Route::get('venture-list-commit', 'Web\NewVentureController@newVentureCommit')->name('venture-list-commit');
        Route::get('/venture-list', 'Web\CurrentVentureController@currentUserList')->name('venture-list');
        Route::get('/portfolio', 'Web\PortfolioController@index')->name('portfolio');
        Route::post('/search-pending-transactions', 'Web\PortfolioController@searchPendingTransactions')->name('portfolio');
        Route::get('/venture-documents/{id}', 'Web\PortfolioController@ventureDocuments');
        Route::post('/user/download-information', 'Web\PortfolioController@downloadInformation');

        Route::delete('/cancel-sell/{id}', 'Web\PortfolioController@cancelSell')->name('cancelSell');
    //new venture routes
        Route::post('currentVentureSearch','Web\CurrentVentureController@ventureSearch');
        Route::get('get-offer-modal/{id}','Web\CurrentVentureController@getOfferModal');
        Route::get('get-buy-now-modal/{id}','Web\CurrentVentureController@getBuyNowModal');
        Route::get('get-sell-modal/{id}','Web\CurrentVentureController@getSellModal');
        Route::get('cancel-sell-listing/{id}','Web\CurrentVentureController@cancelSellListing');
        Route::get('sell-listing-detail/{id}','Web\CurrentVentureController@getSellDetailModal');
        Route::post('save-offer-request','Web\CurrentVentureController@saveOfferRequest')->name('saveOfferRequest');
        Route::post('save-buy-now-request','Web\CurrentVentureController@saveBuyNowRequest')->name('saveBuyNowRequest');
        Route::post('save-selling-ownership-request','Web\CurrentVentureController@saveSellingOwnershipRequest')->name('saveSellingOwnershipRequest');

        Route::get('portfolio', 'Web\PortfolioController@index')->name('portfolio');
        Route::post('portfolio/upload-document', 'Web\PortfolioController@uploadDocument');
        Route::get('current-venture-listings-offers', 'Web\CurrentVentureController@offers')->name('current-venture-listings-offers');
        Route::get('current-venture-listings-buy-now', 'Web\CurrentVentureController@buyNow')->name('current-venture-listings-buy-now');
    //Friend-Referrals
        Route::resource('refer-friends','Web\ReferralController');
    //    Route::post('refer-friend/referralStatus','Web\ReferralUserController@referralStatus');

        Route::get('get-commit-modal/{id}','Web\NewVentureController@getCommitModal');
        Route::get('send-venture-commit-emails','Web\NewVentureController@sendDocumentStatusEmails');
        Route::get('send-venture-buy-now-emails','Web\CurrentVentureController@sendBuyNowDocumentStatusEmails');
        Route::get('send-venture-offers-emails','Web\CurrentVentureController@sendOffersDocumentStatusEmails');
        Route::post('update-buy-now-request-signers-url/{id}','Web\CurrentVentureController@updateBuyNowRequestSignersUrl');
        Route::post('update-offer-request-signers-url/{id}','Web\CurrentVentureController@updateOffersRequestSignersUrl');
        Route::post('save-offer-response','Web\CurrentVentureController@saveOfferResponse');


    });

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Auth\LoginController@index');

    Route::group(['middleware' =>['role:admin']], function () {

        Route::post('delete-venture-offer','Admin\CurrentVentureListingController@deleteVentureOffer');


        Route::post('/store-subAdmin', 'Admin\UserController@storeSubAdmin');
        Route::get('/add-subAdmin', 'Admin\UserController@addSubAdminForm');

        Route::post('/store-property-manager', 'Admin\UserController@storePropertyManager');
        Route::get('/add-property-manager', 'Admin\UserController@addPropertyManagerForm');

        Route::post('/update-password/{user_id}', 'Admin\UserController@updatePassword');
        
        Route::get('/export-users', 'Admin\ExportController@exportUsers')->name('exportUsers');
        Route::get('/export-new-venture-listing', 'Admin\ExportController@exportNewVentureListing')->name('exportNewVentureListing');
        Route::get('/export-current-venture-listing', 'Admin\ExportController@exportCurrentVentureListing')->name('exportCurrentVentureListing');
        Route::get('/export-offers', 'Admin\ExportController@exportOffers')->name('exportOffers');
        Route::get('/export-buy-now', 'Admin\ExportController@exportByNow')->name('exportBuyNow');
        // Other Export Routes        


        // Import Routes
        Route::post('/import-ownership', 'Admin\ImportController@importOwnership');
        Route::post('/import-venture-rental', 'Admin\ImportController@importVentureRental');
        Route::get('/ownership-import-page', 'Admin\ImportController@ownershipImportPage');
        Route::get('/venture-rental-import-page', 'Admin\ImportController@ventureRentalImportPage');



        Route::get('/venture-rental-detail/{id}', 'Admin\VentureRentalController@index');
        Route::post('/venture-rental/store', 'Admin\VentureRentalController@store');
        Route::get('/venture-rental/delete/{id}', 'Admin\VentureRentalController@delete');
        Route::get('/venture-ownership-detail/{id}', 'Admin\VentureOwnershipController@index');
        Route::post('/ownership-update', 'Admin\VentureOwnershipController@update');
        Route::get('/ownership-delete/{id}', 'Admin\VentureOwnershipController@delete');

        Route::get('/venture-transactions/{id}', 'Admin\VentureTransactionController@index');
        Route::get('/venture-transactions/delete/{id}', 'Admin\VentureTransactionController@delete');
        Route::post('/venture-transactions/store', 'Admin\VentureTransactionController@store');
        Route::post('/venture-transactions/update', 'Admin\VentureTransactionController@update');
        
        Route::get('/venture-managers/{id}', 'Admin\VentureManagerController@index');
        Route::get('/venture-managers/delete/{id}', 'Admin\VentureManagerController@delete');
        Route::post('/venture-managers/store', 'Admin\VentureManagerController@store');



        Route::get('/create-listing-select-user', 'Admin\CurrentVentureListingController@createListingSelectUser');


        Route::get('/home', 'Admin\HomeController@index');
        Route::resource('faqs', 'Admin\FaqController');
        Route::resource('sliders', 'Admin\SliderController');
        Route::resource('videos', 'Admin\VideoController');
        Route::resource('pages', 'Admin\PageController');
        Route::resource('users', 'Admin\UserController');
        Route::post('user/cancelUserSubscription', 'Admin\UserController@cancelUserSubscription');
        Route::get('users-search', 'Admin\UserController@searchByName');
        Route::resource('userrequests', 'Admin\UserRequestController');
        Route::resource('plans', 'Admin\PlanController');
        Route::resource('logs', 'Admin\LogController');
        Route::resource('ventures', 'Admin\VentureController');
        Route::get('ventures/del/{id}', 'Admin\VentureController@destroy');
        Route::resource('states', 'Admin\StateController');
        Route::resource('cities', 'Admin\CityController');
        Route::resource('referrals', 'Admin\ReferralController');
        Route::resource('follows', 'Admin\FollowController');
        Route::get('billing-info', 'Admin\UserController@billingInfo')->name('billing-info');
        Route::get('billing-info/{id}', 'Admin\UserController@billingDetail')->name('billing-info');
        Route::post('ckeditor/upload', 'Admin\PageController@upload')->name('ckeditor.upload');
        Route::post('ventures/uploadImages', 'Admin\VentureController@uploadImages')->name('uploadImages');
        Route::post('download-information', 'Admin\VentureController@downloadInformation');
        Route::post('ventures/uploadDocument', 'Admin\VentureController@uploadDocument')->name('UploadVentureDocument');
        Route::post('media-status-change', 'Admin\VentureController@mediaStatusChange');
        Route::post('media-delete', 'Admin\VentureController@mediaStatusDelete');
        //New Venture Listing
        Route::resource('new-venture-listing', 'Admin\NewVentureListingController');
        Route::get('new-venture-listing/{venture_id}/venture-detail/{id}/edit', 'Admin\NewVentureListingController@newVentureListEdit');
        Route::get('new-venture-listing/{venture_id}/venture-detail/{id}/create', 'Admin\NewVentureListingController@newVentureListCreate');
        //    Route::get('new-venture-listing/{venture_id}/venture-detail/{id}/userCommit','Admin\NewVentureListingController@userCommit');
        Route::post('new-venture-listing/userCommitStatus', 'Admin\NewVentureListingController@userCommitStatus');
        Route::get('new-venture-listing/{id}/userCommit', 'Admin\NewVentureListingController@userCommit');
        Route::get('new-venture-listing/removeUserCommit/{id}', 'Admin\NewVentureListingController@removeUserCommit');
        Route::post('update-create-form', 'Admin\NewVentureListingController@updateCreateForm')->name('update-create-form');
        Route::post('newListingVentures/uploadImages', 'Admin\NewVentureListingController@uploadImages')->name('newListingVentureUploadImages');
        Route::post('UploadNewVentureListDocument', 'Admin\NewVentureListingController@uploadDocument')->name('UploadNewVentureListDocument');
        Route::post('searchNewVenture', 'Admin\NewVentureListingController@searchNewVenture')->name('searchNewVenture');
        Route::post('searchVenture', 'Admin\NewVentureListingController@searchVenture')->name('searchVenture');
        Route::post('new-venture-media-delete', 'Admin\NewVentureListingController@mediaStatusDelete');
        Route::post('new-venture-image-delete', 'Admin\NewVentureListingController@imageDelete');
        Route::post('make-image-featured', 'Admin\NewVentureListingController@imageFeatured');
        Route::post('venturesSearch', 'Admin\VentureController@searchVenture')->name('venturesSearch');
        Route::post('change-new-venture-commitment-status', 'Admin\NewVentureListingController@changeListingCommitmentStatus');

        //Current Venture list
        Route::resource('current-venture-listing', 'Admin\CurrentVentureListingController');
        Route::get('current-venture-listing/{venture_id}/venture-detail/{id}/edit', 'Admin\CurrentVentureListingController@currentVentureListEdit');
        Route::get('current-venture-listing/{venture_id}/venture-detail/{id}/create', 'Admin\CurrentVentureListingController@currentVentureListCreate');
        Route::post('update-currentVenture-create-form/{venture_id}', 'Admin\CurrentVentureListingController@updateCurrentVentureForm')->name('update-currentVenture-create-form');
        Route::post('currentListingVentures/uploadImages', 'Admin\CurrentVentureListingController@uploadImages')->name('currentListingVentureUploadImages');
        Route::post('UploadCurrentVentureListDocument', 'Admin\CurrentVentureListingController@uploadDocument')->name('UploadCurrentVentureListDocument');
        Route::post('searchCurrentVenture', 'Admin\CurrentVentureListingController@searchCurrentVenture')->name('searchCurrentVenture');
        Route::post('searchVentures', 'Admin\CurrentVentureListingController@searchVenture')->name('searchVentures');
        Route::post('current-venture-media-delete', 'Admin\CurrentVentureListingController@mediaStatusDelete');
        Route::get('venture-listing/offer', 'Admin\CurrentVentureListingController@offers');
        Route::get('venture-listing/buy-now', 'Admin\CurrentVentureListingController@buyNow');
        Route::post('venture-listing-status', 'Admin\CurrentVentureListingController@status');
        Route::get('selling-ownership-listing', 'Admin\CurrentVentureListingController@sellingOwnershipListing');
        Route::post('searchUser', 'Admin\CurrentVentureListingController@searchUser')->name('searchUser');
        Route::post('deleteBuyNowRequests/{id}', 'Admin\CurrentVentureListingController@deleteBuyNowRequests');

        //Friend-Referrals
        Route::resource('refer-friend', 'Admin\ReferralUserController');
        Route::post('refer-friend/referralStatus', 'Admin\ReferralUserController@referralStatus');

        //Export Buy Now request report
        Route::get('get-buy-now-requests-report', 'Admin\CurrentVentureListingController@getBuyNowReport');

    });
});

Route::group(['prefix' => 'manager'], function () {
    Route::get('/', 'Auth\LoginController@index');

    // Route::group(['middleware' => ['role:manager']], function () {

    Route::get('/home', 'Manager\HomeController@index');

    Route::get('/survey','Manager\SurveyController@index');
    Route::get('/survey/create','Manager\SurveyController@create');
    Route::post('/survey/store','Manager\SurveyController@store');
    Route::post('/survey/bulk-delete','Manager\SurveyController@bulkDestroy');
    Route::post('/surveySearch','Manager\SurveyController@surveySearch');
    Route::get('/surveys/show/{surveyId}','Manager\SurveyController@show');
    Route::get('/surveys/files/{surveyId}','Manager\SurveyController@files');
    Route::get('/surveys/result-send/{surveyId}','Manager\SurveyController@sendResult');
    Route::post('/surveys/uploadImages', 'Manager\SurveyController@uploadImages')->name('surveyUploadImages');
    Route::post('/surveys/uploadDocuments', 'Manager\SurveyController@uploadDocument')->name('UploadSurveyDocument');
    Route::post('/survey/image-delete', 'Manager\SurveyController@imageDelete');





    Route::get('/communication','Manager\MemberCommunicationController@index');
    Route::get('/communication/show/{id}','Manager\MemberCommunicationController@show');
    Route::post('/communication-vo/store','Manager\MemberCommunicationController@storeCommunicationVO');
    Route::post('/communication-vpm/store','Manager\MemberCommunicationController@storeCommunicationVPM');
    Route::post('/communication/bulk-delete','Manager\MemberCommunicationController@bulkDestroy');

    Route::post('/communicationSearch','Manager\MemberCommunicationController@communicationSearch');

    // });
});

