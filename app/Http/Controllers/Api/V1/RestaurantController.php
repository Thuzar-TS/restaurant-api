<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantResourceCollection;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Helpers\CustomLog;

class RestaurantController extends Controller
{
    /**
     * @return RestaurantResourceCollection
     */
    public function index(): RestaurantResourceCollection
    {
        return new RestaurantResourceCollection(Restaurant::paginate());
    }

    /**
     * @return RestaurantResource
     */
    public function show(Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
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

        DB::beginTransaction();
        try {
            $restaurant = Restaurant::create($request->all());
            CustomLog::info("Create New Restaurant ID ".$restaurant->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]
            ], 500);
        }

        return new RestaurantResource($restaurant);
    }

    /**
     * @param Request $request
     * @param Restaurant $restaurant
     * @return RestaurantResource
     */
    public function update(Request $request, Restaurant $restaurant): RestaurantResource
    {
        DB::beginTransaction();
        try {
            $restaurant->update($request->all());
            CustomLog::info("Update Restaurant ID ".$restaurant->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]
            ], 500);
        }

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
        CustomLog::info("Delete Restaurant ID ".$delete_id);

        return response()->json([
			'deleted_id' => $delete_id
		]);
    }
}