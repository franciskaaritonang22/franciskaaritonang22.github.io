@php
    $isPelanggan = auth()->user()->role === 'pelanggan';
@endphp

@if($isPelanggan)
<x-pelanggan-layout title="Profile">
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 border-b border-gray-100">
        <h2 class="text-[2rem] font-bold text-gray-900 tracking-tight leading-tight">Profile</h2>
        <p class="text-gray-500 mt-1 text-sm">Manage your account settings and preferences.</p>
    </div>
    
    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 md:p-10 space-y-6">
        <div class="p-4 sm:p-8 bg-white border border-gray-100 shadow-sm sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white border border-gray-100 shadow-sm sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white border border-gray-100 shadow-sm sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-pelanggan-layout>
@else
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endif
