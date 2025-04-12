<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    /**
     * Список автомобилей
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->query('limit', 10);

        $cars = Car::paginate($limit);

        return response()->json([
            'data' => $cars->items(),
            'pagination' => [
                'current_page' => $cars->currentPage(),
                'pages' => $cars->lastPage(),
                'total' => $cars->total(),
            ],
        ]);
    }

    /**
     * Создание автомобиля
     *
     * @param CarRequest $request
     * @return JsonResponse
     */
    public function store(CarRequest $request): JsonResponse
    {
        $car = Car::create($request->validated());

        return response()->json(['id' => $car->id], 201);
    }

    /**
     * Просмотр конкретного автомобиля
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($car);
    }

    /**
     * Обновление автомобиля
     *
     * @param CarRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CarRequest $request, int $id): JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $car->update($request->validated());

        return response()->json(status: 204);
    }

    /**
     * Удаление автомобиля
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $car->delete();

        return response()->json(status: 204);
    }

    /**
     * Кеш данных
     *
     * @return JsonResponse
     */
    public function availableCarsWithCache(): JsonResponse
    {
        $cars = Cache::remember('cars_cache', 600, function () {
            return $this->availableCars();
        });

        return response()->json($cars);
    }

    /**
     * Вывод актуальных авто
     *
     * @return array
     */
    public function availableCars(): array
    {
        $cars = Car::with(['configurations' => function ($query) {
            $query->whereHas('prices', function ($query) {
                $query->where('end_date', '>=', now())->where('start_date', '<=', now());
            });
        }])->get();

        if ($cars->isEmpty()) {
            return [];
        }

        $result = $cars->map(function ($car) {
            $configurations = $car->configurations->isEmpty() ? [] : $car->configurations->map(function ($configuration) {
                return [
                    'id' => $configuration->id,
                    'name' => $configuration->name,
                    'options' => $configuration->options->pluck('name'),
                    'current_price' => optional($configuration->prices->first())->price,
                ];
            });

            return [
                'id' => $car->id,
                'name' => $car->name,
                'configurations' => $configurations,
            ];
        });

        return $result->toArray();
    }
}
