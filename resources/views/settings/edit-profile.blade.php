@extends('layouts.app')

@section('nav-title')
    Update Profile
@endsection

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-gray-100 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Update Profile
                    </h1>
                    {!! Form::model(auth()->user(), [
                        'url' => url('profile'),
                        'method' => 'post',
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>

                            {!! Form::text('name', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }} mt-3">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>

                            {!! Form::email('email', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="{{ $errors->has('photo') ? ' has-error' : '' }} mt-3">
                        <label for="photo"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Foto Profil</label>
                            {!! Form::file('photo', ['class' => 'block p-2.5 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}
                            {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
                    </div>

                    <button type="submit"
                        class=" mt-5 w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
