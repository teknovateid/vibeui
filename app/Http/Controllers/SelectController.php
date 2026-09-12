<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function index()
    {
        return view('docs.select.index');
    }

    public function api(Request $request): JsonResponse
    {
        $query = trim((string) $request->input('q', ''));
        $like = config('database.default') === 'pgsql' ? 'ilike' : 'like';

        $users = User::query()
            ->when($query !== '', function ($q) use ($query, $like) {
                $q->where(function ($sub) use ($query, $like) {
                    $sub->where('name', $like, "%{$query}%")
                        ->orWhere('email', $like, "%{$query}%")
                        ->orWhere('username', $like, "%{$query}%")
                        ->orWhere('position', $like, "%{$query}%");
                });
            })
            ->limit(12)
            ->get();

        $data = $users->map(function ($user) {
            $descParts = array_filter([
                $user->email,
                $user->position ?: ($user->username ? '@' . $user->username : null),
            ]);

            return [
                'value' => (string) $user->id,
                'label' => $user->name,
                'description' => implode(' • ', $descParts),
                'icon' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff&size=64',
            ];
        });

        return response()->json($data);
    }
}
