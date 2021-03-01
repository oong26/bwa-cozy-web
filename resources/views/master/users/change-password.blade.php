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
                    <form action="{{route('update-password', $user_id)}}" method="post">       
                        @csrf
                        @method('PUT')
                        <div class="py-2">
                            <div class="col mb-4">
                                <x-jet-label for="old_password" class="title-font-size" value="{{ __('Old Password') }}" />
                                <x-jet-input name="old_password" id="old_password" type="password" class="mt-3 block w-full" autocomplete="old_password" placeholder="Enter a old password" required/>
                                @error('old_password')
                                <x-jet-input-error for="old_password" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="new_password" class="title-font-size" value="{{ __('New Password') }}" />
                                <x-jet-input name="new_password" id="new_password" type="password" class="mt-3 block w-full" autocomplete="new_password" placeholder="Enter a new password" required/>
                                @error('new_password')
                                <x-jet-input-error for="new_password" class="mt-2" />
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <x-jet-label for="password_confirmation" class="title-font-size" value="{{ __('Re-type a new Password') }}" />
                                <x-jet-input name="password_confirmation" id="password_confirmation" type="password" class="mt-3 block w-full" autocomplete="password_confirmation" placeholder="Confirmation your password" required/>
                                @error('password_confirmation')
                                <x-jet-input-error for="password_confirmation" class="mt-2" />
                                @enderror
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