<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }} / {{$subtitle}}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('users') }}">
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
                    <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">       
                        @csrf
                        @method('PUT')
                        <div class="py-2">
                            <div class="col mb-4">
                                <x-jet-label for="name" class="title-font-size" value="{{ __('Fullname') }}" />
                                <x-jet-input name="name" id="name" type="text" class="mt-3 block w-full @error('name')" autocomplete="name" placeholder="Enter the Fullname" value="{{ old('name' , $user->name) }}" required/>
                                @error('name')
                                <x-jet-input-error for="name" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="email" class="title-font-size" value="{{ __('Email') }}" />
                                <x-jet-input name="email" id="email" type="email" class="mt-3 block w-full disabled" autocomplete="name" placeholder="Enter a new email" value="{{ old('email', $user->email) }}" readonly/>
                                @error('email')
                                <x-jet-input-error for="email" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="username" class="title-font-size" value="{{ __('Username') }}" />
                                <x-jet-input name="username" id="username" type="text" class="mt-3 block w-full disabled" autocomplete="name" placeholder="Enter a new username" value="{{ old('username', $user->username) }}" readonly/>
                                @error('username')
                                <x-jet-input-error for="username" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="gender" class="title-font-size" value="{{ __('Gender') }}"/>
                                <select name="gender" class="form-control" id="gender" required>
                                    <option value="">Select gender</option>
                                    @if ($user->gender == 'F' || old('gender') == 'F')
                                        <option value="F" selected>Female</option>
                                        <option value="M">Female</option>
                                    @elseif ($user->gender == 'M' || old('gender') == 'M')
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
                                <x-jet-label for="birthday" class="title-font-size" value="{{ __('Birthday') }}" />
                                <x-jet-input name="birthday" id="birthday" type="date" class="mt-3 block w-full"/>
                                @error('username')
                                <x-jet-input-error for="username" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="address" class="title-font-size" value="{{ __('Address') }}" />
                                <textarea name="address" id="address" class="form-control" cols="30" rows="3">{{ $user->address }}</textarea>
                                @error('address')
                                <x-jet-input-error for="address" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="phone" class="title-font-size" value="{{ __('Phone') }}" />
                                <x-jet-input name="phone" id="phone" type="text" class="mt-3 block w-full" placeholder="Enter a new phone number" value="{{ old('phone', $user->phone) }}"/>
                                @error('phone')
                                <x-jet-input-error for="phone" class="mt-2" />
                                @enderror
                                @if ($errors->any())
                                <span id="phone_error" class="error-text">{{ $errors->first() }}</span>
                                @endif
                                <span id="phone_error" class="error-text"></span>
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="role" class="title-font-size" value="{{ __('Role') }}"/>
                                <select name="role" class="form-control" id="role" required>
                                    <option value="">Select role</option>
                                    @foreach ($role as $item)
                                        @if (old('role') == $item->id || $user->id_role == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->role }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->role }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role')
                                <x-jet-input-error for="role" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col">
                                <x-jet-label for="profile" class="title-font-size" value="{{ __('Profile') }}"/>
                                @if (isset($user->profile_photo_url))
                                <img src="{{ asset('uploaded_files/profiles/'.$user->profile_photo_url) }}" class="rounded-sm ml-2" style="width: 100px !important;height: 100px !important;">
                                @endif
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