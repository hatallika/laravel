<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\EditRequest;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('account');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $profile)
    {
        if( Auth::user()->getAuthIdentifier() != $profile->id){
            return redirect()->route('account');
        }
        return view('account.profile.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, User $profile)
    {
        if( Auth::user()->getAuthIdentifier() != $profile->id){
            return redirect()->route('account');
        }
        $fields = ($request->validated());
        //Если не ввели пароль, то он остается прежним. Удаляем поле пароль из записи данных.
        if (($request->input('password')) == null){
            unset($fields ['password']);
        }
        //Если пароль введен то добавим его в изменения
        $fields['password'] = Hash::make($request->input('password'));
        $updated = $profile->fill($fields)->save();

        if($updated){
            return redirect()->route('account')
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
    public function destroy($id)
    {
        //
    }
}
