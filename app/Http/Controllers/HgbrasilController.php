<?php

namespace App\Http\Controllers;

use App\Domain\Services\HgbrasilService;

class HgbrasilController extends Controller
{
    protected $hgbrasilService;

    public function __construct(HgbrasilService $hgbrasilService)
    {
        $this->hgbrasilService = $hgbrasilService;
    }

    public function weather()
    {
        try {
            $weather = $this->hgbrasilService->getWeather();

            return response()->json($weather->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
