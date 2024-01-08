@extends('admin.layouts.dashboard')
@section('title', textLang('title', 'portfolio::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title', 'portfolio::lang'),
    'description' => textLang('description', 'portfolio::lang'),
])
@if(Auth::user()->permission('CREATE_PORTFOLIO'))
@slot('btncreate', config('portfolio.routes.create'))
@endif
@endcomponent

<div class="card">
    <x-admin.elements.table
        :paginate="$portfolios->links('admin.components.paginate')">
        <x-slot:thead>
            <th>{{ textLang('image', 'portfolio::lang.thead') }}</th>
            <th>{{ textLang('title', 'portfolio::lang.thead') }}</th>
            <th>{{ textLang('status', 'portfolio::lang.thead') }}</th>
        </x-slot:thead>
        <x-slot:tbody>
                @foreach ($portfolios as $key => $portfolio)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>
                        <img
                            class="rounded w-10 h-10" 
                            src="{{ $portfolio->image }}" 
                            alt="{{ $portfolio->title }}">
                    </td>
                    <td>{{ $portfolio->title }}</td>
                    <th>
                        <x-admin.elements.status :status="$portfolio->status" />
                    </th>
                    <x-admin.elements.table.action>
                        @slot('buttons')
                            @if(Auth::user()->permission('EDIT_PORTFOLIO'))
                            <li>
                                <x-admin.elements.link 
                                    :title="textLang('Edit')" 
                                    :href="route(config('portfolio.routes.edit'), ['portfolio' => $portfolio->id])"  
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="pencil" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements-link>
                            </li>
                            @endif
                            @if(Auth::user()->permission('DELETE_PORTFOLIO'))
                            <li>
                            <form 
                                class="block full"
                                action="{{ route(config('portfolio.routes.delete'), ['portfolio' => $portfolio->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin.elements.button 
                                    type="submit" 
                                    :title="textLang('Delete')" 
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="trash" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements.button>
                            </form>
                            </li>
                            @endif
                        @endslot
                    </x-admin.elements.table.action>
                <tr>
                @endforeach
        </x-slot:tbody>
    </x-admin.page.table.table>
</div>
@endsection