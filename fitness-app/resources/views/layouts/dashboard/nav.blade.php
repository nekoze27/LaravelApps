<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-8">
            <span class="text-xl font-semibold text-primary">FitnessApp</span>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Home</a>
            <a href="{{ route('diary_entries.index') }}"  class="text-gray-600 hover:text-primary">Diary</a>
            <a href="/"  class="text-gray-600 hover:text-primary">Stats</a>
            <a href="{{ route('food.index') }}"  class="text-gray-600 hover:text-primary">MyFood</a>
            <a href="{{ route('dashboard.food') }}"  class="text-gray-600 hover:text-primary">Food</a>
            <a href="/"  class="text-gray-600 hover:text-primary">Exercises</a>

            {{-- <div class="text-lg font-bold text-bure-800">{{ env('APP_NAME') }}</div>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">Home</a></li>
                    <li><a href="{{ route('diary_entries.index') }}"  class="text-gray-600 hover:text-primary">Diary</a></li>
                    <li><a href="/"  class="text-gray-600 hover:text-primary">Stats</a></li>
                    <li><a href="{{ route('food.index') }}"  class="text-gray-600 hover:text-primary">MyFood</a></li>
                    <li><a href="{{ route('dashboard.food') }}"  class="text-gray-600 hover:text-primary">Food</a></li>
                    <li><a href="/"  class="text-gray-600 hover:text-primary">Exercises</a></li>
                </ul> --}}
        </div>
        <div class="flex items-center space-x-4">
            <x-dropdown-link :href="route('profile.edit')">
                {{ Auth::user()->name }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('LogOut') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</nav>
