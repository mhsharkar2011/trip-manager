<x-app-layout title="Edit Page">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('cms.update', $data->id) }}">
                        @method('PUT')
                        @csrf


                        <div class="px-4 py-3 bg-gray-50 sm:px-4">
                            <a title="Go back" href="{{ route('cms.index') }}">
                                <svg class="mr-2 w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </a>


                            Page: {{ ucwords($data->path) }}

                            <a class="ml-2 underline text-sm text-gray-600 hover:text-gray-900" href="{{url($data->route)}}" target="_blank">
                                OPEN
                                <div class="w-4 mr-2 inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </div>
                            </a>

                        </div>


                        @if (session('status'))
                        <div class="mt-4 py-3 px-5 mb-4 bg-gray-300 text-gray-900 rounded-md text-sm border border-gray-400" role="alert">
                        {{ session('status') }}
                        </div>
                        @endif

                        <div class="mt-4 py-3 px-5 mb-4 bg-gray-100 text-gray-900 rounded-md text-sm border border-gray-200" role="alert">
                           @if ((request()->has('template')))
                            <a title="Go back" href="{{ route('cms.edit', $data->id) }}">
                                <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </a>
                           @endif

                            Related templates: 
                           @foreach ($components as $c)
                                <a href="{{ route('cms.edit', [$data->id, 'template' => $c]) }}">
                                    <strong>{{ humanize($c) }}</strong>
                                </a>
                                {{ !$loop->last? ',' : ''}}
                           @endforeach
                        </div>
                        
                        @if ($tpl = request()->get('template'))
                            <input type="hidden" name="related_template" value="{{ $tpl }}">
                        @endif

                        <div class="mt-4">
                            <textarea id="summernote" name="template" rows="50" class="shadow-sm focus:ring-gray-500 focus:border-gray-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ $page_template_content }}</textarea>
                        </div>

                        <br>

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>

</x-app-layout>
