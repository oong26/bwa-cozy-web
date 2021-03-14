<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }} / {{$subtitle}}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('boarding-house') }}">
                <x-jet-button class="secondary mr-2">
                    <i class="fa fa-arrow-left"></i>&nbsp;
                    Back
                </x-jet-button>
            </a>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
                <div class="px-4 py-3 bg-white sm:p-6">
                    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">       
                        @csrf
                        <div class="py-2">
                            <div class="col mb-4">
                                <x-jet-label for="name" class="title-font-size" value="{{ __('Fullname') }}" />
                                <x-jet-input name="name" id="name" type="text" class="mt-3 block w-full @error('name')" autocomplete="name" placeholder="Enter the Fullname" value="{{ old('name') }}" />
                                @error('name')
                                <x-jet-input-error for="name" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="email" class="title-font-size" value="{{ __('Email') }}" />
                                <x-jet-input name="email" id="email" type="email" class="mt-3 block w-full" autocomplete="name" placeholder="Enter a new email" value="{{ old('email') }}" />
                                @error('email')
                                <x-jet-input-error for="email" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="username" class="title-font-size" value="{{ __('Username') }}" />
                                <x-jet-input name="username" id="username" type="text" class="mt-3 block w-full" autocomplete="name" placeholder="Enter a new username" value="{{ old('username') }}" />
                                @error('username')
                                <x-jet-input-error for="username" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="gender" class="title-font-size" value="{{ __('Gender') }}"/>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="">Select gender</option>
                                    @if (old('gender') == 'F')
                                        <option value="F" selected>Female</option>
                                        <option value="M">Female</option>
                                    @elseif (old('gender') == 'M')
                                        <option value="F">Female</option>
                                        <option value="M" selected>Male</option>
                                    @else
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    @endif
                                </select>
                                @error('gender')
                                <x-jet-input-error for="gender" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="password" class="title-font-size" value="{{ __('Password') }}" />
                                <x-jet-input name="password" id="password" type="password" class="mt-3 block w-full" autocomplete="password" placeholder="Enter a new password"/>
                                @error('password')
                                <x-jet-input-error for="password" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="password_confirmation" class="title-font-size" value="{{ __('Re-type Password') }}" />
                                <x-jet-input name="password_confirmation" id="password_confirmation" type="password" class="mt-3 block w-full" autocomplete="password_confirmation" placeholder="Confirmation your password"/>
                                @error('password_confirmation')
                                <x-jet-input-error for="password_confirmation" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col">
                                <x-jet-label for="profile" class="title-font-size" value="{{ __('Profile') }}"/>                 
                                <input type="file" name="profile" id="profile" class="form-control">
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <div class="col-span-6 sm:col-span-4 mt-3">
                                    <x-jet-button class="primary">Save</x-jet-button>
                                </div>
                                <div class="col-span-6 sm:col-span-4 mt-3 mr-2">
                                    <x-jet-button type="reset" class="danger">Reset</x-jet-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>