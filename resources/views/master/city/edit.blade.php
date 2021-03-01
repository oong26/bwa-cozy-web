<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }} / {{$subtitle}}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('city') }}">
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
                    <form action="{{route('city.update', $city->id)}}" method="post">       
                        @csrf
                        @method('PUT')
                        <div class="py-2">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="city" class="title-font-size" value="{{ __('City') }}" />
                                <x-jet-input name="city" id="city" type="text" class="mt-3 block w-full" value="{{ old('city', $city->name) }}" autocomplete="city" placeholder="Enter a new city" />
                                @error('city')
                                <x-jet-input-error for="city" class="mt-2" />
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