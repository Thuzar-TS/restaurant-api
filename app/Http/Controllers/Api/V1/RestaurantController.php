<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantResourceCollection;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * @return RestaurantResource
     */
    public function show(Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * @return RestaurantResourceCollection
     */
    public function index(): RestaurantResourceCollection
    {
        return new RestaurantResourceCollection(Restaurant::paginate());
    }

    /**
     * @param Request $request
     * @return RestaurantResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'logo' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);

        $restaurant = Restaurant::create($request->all());

        return new RestaurantResource($restaurant);
    }

    /**
     * @param Request $request
     * @param Restaurant $restaurant
     * @return RestaurantResource
     */
    public function update(Request $request, Restaurant $restaurant): RestaurantResource
    {
        $restaurant->update($request->all());

        return new RestaurantResource($restaurant);
    }

    /**
     * @param Restaurant $restaurant
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Restaurant $restaurant)
    {
        $delete_id = $restaurant->id;
        $restaurant->delete();

        return response()->json([
			'deleted_id' => $delete_id
		]);
    }
}