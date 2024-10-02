
<form action="{{ $routeUrl }}" method="POST">
    @csrf
    @method($method)

    <div class="mb-4">
        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="datetime-local" name="date" id="date" value="{{ old('date', optional($diaryEntry->date)->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full" required>
    </div>

    {{-- <div class="mb-4">
        <label for="entry" class="block text-sm font-medium text-gray-700">Entry</label>
        <textarea name="entry" id="entry" rows="4" class="mt-1 block w-full" required>{{ old('entry', $diaryEntry->entry ?? '') }}</textarea>
    </div> --}}

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Entry</button>
</form>

