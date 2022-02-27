<?php

namespace App\Plugins\Product\v1;

use App\AppAdapter\AppRequest;
use App\Plugins\Pricing\Service\PricingService;
use App\Plugins\Product\Service\ProductService;
use App\Plugins\Shipment\Service\ShipmentService;

class ProductModel
{
    private ProductService $productService;
    private ShipmentService $shipmentService;
    private PricingService $pricingService;

    public function __construct(
        ProductService $productService,
        PricingService $pricingService,
        ShipmentService $shipmentService
    )
    {
        $this->pricingService = $pricingService;
        $this->productService = $productService;
        $this->shipmentService = $shipmentService;
    }

    public function create(AppRequest $appRequest) : int
    {
        $test1 = $this->productService->createProduct();
        $test2 = $this->pricingService->calculatePrice();
        $test3 = $this->shipmentService->calculateShipment();
        return 0;
    }    
}
