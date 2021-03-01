<x-app-layout :pagetitle="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-4">
        <div class="d-flex justify-content-between">
            <x-jet-input class="w-50 px-3 py-2 ml-2" placeholder="Find in here..."></x-jet-input>
            <a href="{{ route('boarding-house.create') }}">
                <x-jet-button class="primary mr-2">
                    <i class="fa fa-plus"></i>&nbsp;
                    Add
                </x-jet-button>
            </a>
        </div>
    </div>

    {{-- <div class="py-4"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
                <div class="limiter">
                    {{-- Table --}}
                    <div class="custom-table">
            
                        <div class="custom-table-row custom-table-header primary">
                            <div class="custom-table-cell">
                                #
                            </div>
                            <div class="custom-table-cell">
                                Name
                            </div>
                            <div class="custom-table-cell">
                                Location
                            </div>
                            <div class="custom-table-cell">
                                Address
                            </div>
                            <div class="custom-table-cell">
                                Price/month
                            </div>
                            <div class="custom-table-cell">
                                Options
                            </div>
                        </div>

                        @foreach ($boarding_house as $item)
                        <div class="custom-table-row">
                            <div class="custom-table-cell">
                                {{$loop->iteration}}
                            </div>
                            <div class="custom-table-cell">
                                {{$item->house_name}}
                            </div>
                            <div class="custom-table-cell">
                                {{$item->city_name}}, {{$item->country_name}}
                            </div>
                            <div class="custom-table-cell">
                                {{$item->address}}
                            </div>
                            <div class="custom-table-cell">
                                Rp. {{number_format($item->price, 2, '.', ',')}}
                            </div>
                            <div class="custom-table-cell p-2">
                                <div class="dropdown dropdown-link">
                                    <button type="button" style="border: 1px solid grey;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        Choose your option
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('boarding-house.edit', $item->id) }}" class="dropdown-item">{{ __('Edit') }}</a>
                                        <form action="{{ route('boarding-house.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="mr-1 dropdown-item" onclick="confirm('{{ __("Are you sure to delete this data?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    {{-- End Table --}}
                    {{-- {{$boarding_house->appends(Request::all())->links('vendor.pagination.custom')}} --}}
                </div>
            </div>
        </div>
    {{-- </div> --}}
</x-app-layout>