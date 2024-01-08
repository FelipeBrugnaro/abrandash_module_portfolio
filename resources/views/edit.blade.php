@extends('admin.layouts.dashboard')
@section('title', textLang('title_edit', 'portfolio::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_edit', 'portfolio::lang'),
    'description' => textLang('description_edit', 'portfolio::lang'),
    'btnback' => config('portfolio.routes.index')
])
@endcomponent

<div class="card">
    <form 
        action="{{ route(config('portfolio.routes.update'), ['portfolio' => $portfolio->id]) }}" 
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('portfolio::partials.form')

        <x-admin.elements.select 
            name="status" 
            :label="textLang('status', 'portfolio::lang.form')">
            <option 
                value="1" 
                @if ($portfolio->status == true) selected @endif>
            <span>{{ textLang('Actived') }}</span>
            </option>
            <option 
                value="0" 
                @if ($portfolio->status == false) selected @endif>
            <span>{{ textLang('Disabled') }}</span>
            </option>
        </x-admin.elements.select>
        
        <div class="flex items-center justify-end gap-3">
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-primary" 
                type="submit" 
                :title="textLang('Edit')" />
        </div>
    </form>
</div>
@endsection