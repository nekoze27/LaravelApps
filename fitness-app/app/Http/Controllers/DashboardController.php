<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\FoodSearchRequest;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodType;
use App\View\Components\Dashboard\FoodCards;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller implements HasMiddleware
{
    public function home(Request $request): View {
        return view('dashboard.home');
    }

    public function food(FoodSearchRequest $request): View {
        $query = $this->foodSearchQuery($request->toArray());

        return view('dashboard.food', [
            'foodTypes' => FoodType::all(),
            'food' => $query->orderByDesc('created_at')->paginate(10)->withQueryString(),
        ]);
    }

    public function foodSearch(FoodSearchRequest $request): JsonResponse {
        // 検索クエリを実行
        $query = $this->foodSearchQuery($request->toArray());

        // ページネーションとGETリンクを使用してデータを取得
        $foodPaginator = $query->orderByDesc('created_at')->paginate(perPage: 10)->withPath(route('dashboard.food'));

        // FoodCardsコンポーネントをインスタンス化し、ビューを生成
        $foodCardsComponent = new FoodCards($foodPaginator);
        $content = $foodCardsComponent->render()->with($foodCardsComponent->data())->render();

        // JSONレスポンスを返す
        return response()->json([
            'food' => $foodPaginator->items(), // 食品データをJSONとして返す
            'content' => $content, // ビューの内容もJSONとして返す
        ]);
    }

    // フィルタリングのためのクエリビルダーを生成するメソッド
    private function foodSearchQuery(array $data): Builder {
        $query = Food::query(); // Foodモデルのクエリビルダーを作成

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (!empty($data['food_type'])) {
            $query->whereHas('foodType', function($q) use ($data) {
                $q->where('name', $data['food_type']);
            });
        }

        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            foreach ($tags as $tag) {
                $query->whereHas('foodTags', function($q) use ($tag) {
                    $q->where('name', $tag);
                });
            }
        }

        return $query;
    }

    public static function middleware(): array
    {
        return [
            'auth',
            'verified',
        ];
    }
}
