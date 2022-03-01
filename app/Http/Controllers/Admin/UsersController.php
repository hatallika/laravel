<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::query()->select(User::$availableFields)->get();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $created = User::create(
           $request->only(
               ['name', 'email', 'is_admin']) +
               ['password' => Hash::make($request->input('password')) ]
       );

        if($created){
            return redirect()->route('admin.users.index')
                ->with('success', 'Пользователь успешно добавлен');
        }

        return back()->with('error', 'Не удалось добавить пользователя')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, User $user)
    {

        $fields = ($request->validated());

        //Если в админке не ввели новый пароль, то он остается прежним. Удаляем поле пароль из записи данных.
        if (($request->input('password')) == null){
            unset($fields ['password']);
        }
        //Если пароль введен то добавим его в изменения
        $fields['password'] = Hash::make($request->input('password'));
        $updated = $user->fill($fields)->save();

        if($updated){
            return redirect()->route('admin.users.index')
                ->with('success', 'данные успешно обновлены');
        }
        return back()->with('error', 'Не удалось изменить данные')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return response()->json('ok');
        }catch (\Exception $e){
            \Log::error("Не удалось удалить пользователя");
        }
    }
}
