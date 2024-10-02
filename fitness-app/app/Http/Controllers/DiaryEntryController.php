<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;


class DiaryEntryController extends Controller
{
    public function index()
    {
        $diary_entries = auth()->user()->diaryEntry()->orderBy('date', 'desc')->paginate(10);

        return Blade::render(
            <<<'blade'
            <x-dashboard-layouts>
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-xl font-bold mb-4">Diary Entries</h2>

                    {{-- <!-- 日記エントリ作成フォーム -->
                    <form action="{{ route('diary_entries.store') }}" method="POST">
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
                    </form> --}}

                    <!-- 日記エントリの一覧表示 -->
                    @if($diary_entries->count())
                        {{-- <ul class="mt-4">
                            @foreach($diary_entries as $entry)
                                <li class="mb-4">
                                    <strong>{{ $entry->date->format('Y-m-d H:i') }}</strong>
                                    <p>{{ $entry->entry }}</p>
                                </li>
                            @endforeach
                        </ul> --}}
                        <ul class="mt-4">
                            @foreach($diary_entries as $entry)
                                <li class="mb-4 flex justify-between items-center">
                                    <div class="flex-1">
                                        <strong>{{ $entry->date->format('Y-m-d H:i') }}</strong>
                                        <p>{{ $entry->entry }}</p>
                                    </div>

                                    <!-- ボタンを右寄せに配置 -->
                                    <div class="flex space-x-4">
                                        <!-- 編集ボタン -->
                                        <a href="{{ route('diary_entries.edit', $entry) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>

                                        <!-- 削除ボタン -->
                                        <form action="{{ route('diary_entries.destroy', $entry) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-400 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $diary_entries->links() }}
                    @else
                        <p>No diary entries yet.</p>
                    @endif

                    <!-- 新規作成ボタン -->
                    <div class="flex justify-center mt-4">
                        <a href="{{ route('diary_entries.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded  ">Create New Entry</a>
                    </div>
                </div>
            </x-dashboard-layouts>
            blade,
            [
                'diary_entries' => $diary_entries,
            ]
        );
    }

    public function create()
    {
        return Blade::render(
            <<<'blade'
                <x-dashboard-layout>
                    <x-dashboard.diary-entry.diary-entry-form :route-url="$route" method="POST">
                    </x-dashboard.diary-entry.diary-entry-form>
                </x-dashboard-layout>
            blade,
            [
                'route' => route('diary_entries.store'),
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        DiaryEntry::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
        ]);

        return redirect()->route('diary_entries.index')->with('success', 'Diary entry created successfully.');
    }

    // public function show(Food $food)
    // {
    //     //
    // }

    public function edit(DiaryEntry $diaryEntry)
    {
        return Blade::render(
            <<<'blade'
                <x-dashboard-layout>
                    <x-dashboard.diary-entry.diary-entry-form :route-url="$route" method="PUT" :diary_entry="$diaryEntry">
                    </x-dashboard.diary-entry.diary-entry-form>
                </x-dashboard-layout>
            blade,
            [
                // 更新用のルートと編集する食品データを渡す
                'route' => route('diary_entries.update', $diaryEntry),
                'diaryEntry'=> $diaryEntry
            ]
        );
    }

    public function update(Request $request, DiaryEntry $diaryEntry)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $diaryEntry->update($request->only('date'));

        return redirect()->route('diary_entries.index')->with('success', 'Diary entry updated successfully.');
    }

    public function destroy(DiaryEntry $diaryEntry)
    {
        $diaryEntry->delete();
        return redirect()->route('diary_entries.index')->with('success', 'Diary entry deleted successfully.');
    }
}
