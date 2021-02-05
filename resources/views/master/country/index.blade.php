<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-4">
        <div class="d-flex justify-content-between">
            <x-jet-input class="w-50 px-3 py-2 ml-2" placeholder="Find in here..."></x-jet-input>
            <a href="{{ route('country.create') }}">
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
                                Country
                            </div>
                            <div class="custom-table-cell">
                                Options
                            </div>
                        </div>

                        @foreach ($country as $item)
                        <div class="custom-table-row">
                            <div class="custom-table-cell">
                                {{$loop->iteration}}
                            </div>
                            <div class="custom-table-cell">
                                {{$item->name}}
                            </div>
                            <div class="custom-table-cell p-2">
                                <div class="dropdown dropdown-link">
                                    <button type="button" style="border: 1px solid grey;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        Choose your option
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('country.edit', $item->id) }}" class="dropdown-item">{{ __('Edit') }}</a>
                                        <form action="{{ route('country.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="mr-1 dropdown-item" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
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
                    {{-- {{$role->appends(Request::all())->links('vendor.pagination.custom')}} --}}
                </div>
            </div>
        </div>
    {{-- </div> --}}
</x-app-layout>