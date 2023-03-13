<?php

return [
    //Defining Ventures Medias Path
    'ADMIN_EMAIL' => 'sample@gmail.com',
    'ventureMediaPath' => 'uploads/ventures/',
    'surveyMediaPath' => 'uploads/surveys/',
    'mediaImageType' => 'IMAGE',
    'mediaDocumentType' => 'FILE',
    'NEW_VENTURE_LISTING' => 'NEW',
    'CURRENT_VENTURE_LISTING' => 'CURRENT',
    'CURRENCY_SIGN' => '$',
    'STRIPE_KEY'=>env('STRIPE_KEY'),
    'STRIPE_SECRET'=>env('STRIPE_SECRET'),
    'VENTURE_TYPE' => [
        'Single Family', 'Multi Family', 'Retail', 'Commercial'
    ],
    'VENTURE_SOURCE_TYPE' => [
        'In House', 'Member', 'Other'
    ],

    'VENTURE_LISTING_STATUS' => [
        'Pending','Selling', 'Sold'
    ],

    'NEW_VENTURE_LISTING_STATUS' => [
        'Negotiating','Deal Dead', 'Closing','Closed'
    ],
    'VENTURE_COMMIT_STATUS' => [
        'Pending', 'Committed','Funding',
    ],
    'VENTURE_COMMIT_STATUS_COLOR' => [
        'Pending' => 'info',
        'Committed' => 'success',
        'Funding' => 'primary',
        'Negotiating' => 'warning',
        'Deal Dead' => 'danger',
        'Closing' => 'success',
        'Closed' => 'success',
    ],
    'VENTURE_BUY_NOW_STATUS' => [
        'Pending Buyer Docs', 'Pending Seller Docs','Funding','Closing','Closed',
    ],
    'VENTURE_BUY_NOW_STATUS_COLOR' => [
        'Pending Buyer Docs' => 'primary', 'Pending Seller Docs' => 'primary','Funding' => 'success','Closing' => 'warning', 'Closed' => 'success',
    ],
    'VENTURE_OFFER_STATUS' => [
        'New Offer', 'Accepted','Declined','Pending Buyer Docs','Pending Seller Docs','Funding','Closing','Closed'
    ],
    'VENTURE_OFFER_STATUS_COLOR' => [
        'New Offer' => 'info', 'Accepted' => 'primary','Declined' => 'danger','Pending Buyer Docs' => 'warning','Pending Seller Docs' => 'warning','Funding' => 'success','Closing' => 'success','Closed' => 'success'
    ],
    'COMMIT_REQUEST_TEMPLATE_ID_FROM_EVERSIGN' => '6d5de1fdb6d5456ba8582482336eb70d',
    'BUY_NOW_REQUEST_TEMPLATE_ID_FROM_EVERSIGN' => 'f39c1eda95304b98a9cdd2929277bc30',
    'OFFER_REQUEST_TEMPLATE_ID_FROM_EVERSIGN' => '56472c129fea4fd0a01868e59f5f3526',
];

