@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Alumni Surveys</h1>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Graduate</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Submitted</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($surveys as $survey)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $survey->id }}</td>
                        <td class="px-4 py-2">{{ optional($survey->graduate)->full_name ?? optional($survey->user)->name }}</td>
                        <td class="px-4 py-2">{{ $survey->submitted_at?->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('admin.surveys.show', $survey) }}" class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $surveys->links() }}</div>
    </div>
</div>
@endsection


