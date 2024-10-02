{{-- <x-dashboard-layouts>
    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Diary Entries</h2>

        <!-- 日記エントリ作成フォーム -->
        <form action="{{ route('dashboard.diary.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="datetime-local" name="date" id="date" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="entry" class="block text-sm font-medium text-gray-700">Entry</label>
                <textarea name="entry" id="entry" rows="4" class="mt-1 block w-full" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Entry</button>
        </form>

        <!-- 日記エントリの一覧表示 -->
        @if($entries->count())
            <ul class="mt-4">
                @foreach($entries as $entry)
                    <li class="mb-4">
                        <strong>{{ $entry->date->format('Y-m-d H:i') }}</strong>
                        <p>{{ $entry->entry }}</p>
                    </li>
                @endforeach
            </ul>

            {{ $entries->links() }}
        @else
            <p>No diary entries yet.</p>
        @endif
    </div>
</x-dashboard-layouts> --}}
