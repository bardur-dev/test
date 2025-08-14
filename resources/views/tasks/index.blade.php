<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tasks.store') }}" class="mb-8">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-label for="title" :value="__('New Task')" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                            </div>
                            <div>
                                <x-label for="description" :value="__('Description (optional)')" />
                                <textarea id="description" name="description" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <x-button>
                                    {{ __('Add Task') }}
                                </x-button>
                            </div>
                        </div>
                    </form>

                    <div class="space-y-4">
                        @forelse ($tasks as $task)
                            <div class="flex items-start justify-between p-4 bg-white rounded-lg shadow-xs hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-start space-x-4 flex-1 min-w-0">
                                    <form method="POST" action="{{ route('tasks.update', $task) }}" class="mt-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="completed" value="{{ $task->completed ? '0' : '1' }}">
                                        <button type="submit" class="focus:outline-none">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" {{ $task->completed ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out rounded">
                                            </div>
                                        </button>
                                    </form>

                                    <div class="flex-1 min-w-0">
                                        <div class="{{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                            <p class="text-lg font-medium truncate">{{ $task->title }}</p>
                                            @if($task->description)
                                                <p class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ $task->description }}</p>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">
                                            {{ $task->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 focus:outline-none transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900">No tasks yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new task.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
