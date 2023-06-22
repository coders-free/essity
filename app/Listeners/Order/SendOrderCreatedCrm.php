<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class SendOrderCreatedCrm
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Http::post('', [
            'SalesOrders' => [
                'MessageHeader' => [
                    'CreationDateTime' => $event->order->created_at->format('Y-m-d\TH:i:s\Z'),
                    'SenderBusinessSystemID' => 'eShopHMS_ES',
                ],
                'orderHeader' => [
                    'salesOrganization' => 'DE680100',
                    'number' => $event->order->id,
                    'extension' => [
                        'lifecycleStatus' => '798030000'
                    ]
                ],
                'organizationalData' => [
                    [
                        'qualifier' => 'ZCRM',
                        'organizationID' => '798030001'
                    ],
                    [
                        'qualifier' => 'ZDIV',
                        'organizationID' => '220'
                    ],
                    [
                        'qualifier' => 'ZDST',
                        'organizationID' => '798030000'
                    ]
                ],
                'partners' => [
                    [ 
                        "function" => "WE", 
                        "number" => "50128763", 
                        "referenceCode" => "123456" 
                    ],
                    [
                        "function" => "AG", 
                        "number" => "1556457", 
                        "email" => "123@test.com" 
                    ]
                ],
                'texts' => [
                    'textTypeID' => 'INF',
                    'lines' => [
                        'line' => 'Created by Spain Eshop'
                    ]
                ]
            ]
        ]);
    }
}
