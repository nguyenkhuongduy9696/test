<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getList(Request $request)
    {
        $perPage = $request->perpage;
        $sort = explode(',', str_replace(array('[', '"', ']'), '', $request->sort));
        $url = $request->filter;
        if (strlen($url) == 2) {
            $user = User::orderBy($sort[0], $sort[1])->paginate($perPage);
        } else {
            $filter = explode(':', str_replace(array('{', '"', '}'), '', $url));
            $user = User::where('name', 'LIKE', '%' . $filter[1] . '%')->orderBy($sort[0], $sort[1])->paginate($perPage);
        }
        return response()->json($user, 200);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        $user = User::create($data);
        return response()->json($user, 200);
    }
    public function getOne(User $user)
    {
        return response()->json($user, 200);
    }
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $user->update($data);
        return response()->json($user, 200);
    }
    public function delete(User $user)
    {
        $user->delete();
        $users = User::all();
        return response()->json($users, 200);
    }
    public function deleteMany(Request $request)
    {
        if ($request->has('filter')) {
            $query = $request->filter;
            $arr1 = str_replace(array('[', ']', '}'), '', explode(':', $query));
            $arr = explode(',', $arr1[1]);
            User::destroy($arr);
            return response()->json(User::paginate(5), 200);
        }
    }
}
