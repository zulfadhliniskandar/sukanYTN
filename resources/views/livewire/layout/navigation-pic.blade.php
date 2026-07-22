<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <img class="h-20 w-20" src="{{ asset('icons/logotsytn.png') }}" alt="TSYTN Logo">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('listMatch')" :active="request()->routeIs('listMatch')" wire:navigate>
                        {{ __('Matches') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('approveRegistration')" :active="request()->routeIs('approveRegistration')"
                        wire:navigate>
                        {{ __('Approve Registration') }}
                    </x-nav-link>
                </div>

                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('addVenue')" :active="request()->routeIs('addVenue')" wire:navigate>
                        {{ __('Add Venue') }}
                    </x-nav-link>
                </div> --}}

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('listVenue')" :active="request()->routeIs('listVenue')" wire:navigate>
                        {{ __('Venues') }}
                    </x-nav-link> {{-- Nanti sini cek sbb admin sj yg akan add the venue --}}
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('listSport')" :active="request()->routeIs('listSport')" wire:navigate>
                        {{ __('Sports') }}
                    </x-nav-link> {{-- Nanti sini cek sbb admin sj yg akan add the venue --}}
                </div>
                @if(auth()->user()->hasRole(['Admin']))
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('listContingents')" :active="request()->routeIs('listContingent')"
                            wire:navigate>
                            {{ __('Contingents') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('assignMatchParticipants')"
                            :active="request()->routeIs('assignMatchParticipants')" wire:navigate>
                            {{ __('Assign Match Participants') }}
                        </x-nav-link>
                    </div>
                @endif

                @impersonating
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('impersonate.leave') }}"
                        class="inline-flex items-center px-4 py-1.5 border border-transparent text-sm font-bold rounded-full text-rose-700 bg-rose-100 hover:bg-rose-200 hover:text-rose-800 transition-colors shadow-sm self-center ml-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Leave Impersonation
                    </a>
                </div>
                @endImpersonating



                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('scores.manage', ['match_id' => $match->id])"
                        :active="request()->routeIs('scores.manage', ['match_id' => $match->id])" wire:navigate>
                        {{ __('Manage Scores') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('listMatch')" :active="request()->routeIs('listMatch')" wire:navigate>
                {{ __('Matches') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('approveRegistration')"
                :active="request()->routeIs('approveRegistration')" wire:navigate>
                {{ __('Approve Registration') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('listVenue')" :active="request()->routeIs('listVenue')" wire:navigate>
                {{ __('Venues') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('listSport')" :active="request()->routeIs('listSport')" wire:navigate>
                {{ __('Sports') }}
            </x-responsive-nav-link>
            @if(auth()->user()->hasRole(['Admin']))
                <x-responsive-nav-link :href="route('listContingents')" :active="request()->routeIs('listContingents')"
                    wire:navigate>
                    {{ __('Contingents') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('assignMatchParticipants')"
                    :active="request()->routeIs('assignMatchParticipants')" wire:navigate>
                    {{ __('Assign Match Participants') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @impersonating
        <div class="pt-2 pb-3 px-4 border-t border-gray-200">
            <a href="{{ route('impersonate.leave') }}"
                class="flex items-center justify-center w-full px-4 py-2 border border-transparent text-sm font-bold rounded-lg text-rose-700 bg-rose-100 hover:bg-rose-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Leave Impersonation
            </a>
        </div>
        @endImpersonating

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800"
                    x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>