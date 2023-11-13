@extends('layouts.app')

@section('nav-title')
    Ubah Password
@endsection

@section('content')

    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <form action="{{ url('/settings/password') }}" method="POST">
                    @csrf
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Password lama', ['class' => 'mb-2 font-semibold']) !!}
                        <div class="mb-6">
                            {!! Form::password('password', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        {!! Form::label('new_password', 'Password baru', ['class' => 'mb-2 font-semibold']) !!}
                        <div class="mb-6">
                            {!! Form::password('new_password', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
                            {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('new_password_confirmation', 'Konfirmasi password baru', ['class' => 'mb-2 font-semibold']) !!}
                        <div class="mb-6">
                            {!! Form::password('new_password_confirmation', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
                            {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <button type="submit"
                        class="font-semibold text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
