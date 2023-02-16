<div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
        {{ config('app.name') }}
    </a>
    <ul class="mt-6">
        <li class="relative px-6 py-3">
            {!! request()->routeIs('dashboard') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{route('dashboard')}}">
                <span class="ml-4">{{ __('Dashboard') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('logviewer.iframe') }}">
                <span class="ml-4">{{ __('Logs') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('apiexplorer.compass.iframe') }}">
                <span class="ml-4">{{ __('API Explorer (Postman)') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('apiexplorer.iframe') }}">
                <span class="ml-4">{{ __('API Explorer (old)') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('telescope.iframe') }}">
                <span class="ml-4">{{ __('Telescope') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('webtinker.iframe') }}">
                <span class="ml-4">{{ __('Tinker') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('artisangui.iframe') }}">
                <span class="ml-4">{{ __('Artisan Commands') }}</span>
            </a>
        </li>

        <li class="relative px-6 py-3">
            {!! request()->routeIs('telescope') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{ route('phpinfo') }}">
                <span class="ml-4">{{ __('PHP Info') }}</span>
            </a>
        </li>

        {{-- 
        <li class="relative px-6 py-3">
            {!! request()->routeIs('forms') ? '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('forms')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                <span class="ml-4">Forms</span>
            </a>
        </li>
         --}}

        <li class="relative px-6 py-3">
          <button
            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
            @click="togglePagesMenu"
            aria-haspopup="true"
          >
            <span class="inline-flex items-center">

              <span class="ml-4">Theme Pages</span>
            </span>
            <svg
              class="w-4 h-4"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </button>
          <template x-if="isPagesMenuOpen">
            <ul
              x-transition:enter="transition-all ease-in-out duration-300"
              x-transition:enter-start="opacity-25 max-h-0"
              x-transition:enter-end="opacity-100 max-h-xl"
              x-transition:leave="transition-all ease-in-out duration-300"
              x-transition:leave-start="opacity-100 max-h-xl"
              x-transition:leave-end="opacity-0 max-h-0"
              class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
              aria-label="submenu"
            >
              <li 
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('forms')}}">Forms</a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('cards')}}">
                  Cards
                </a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('charts')}}">
                  Charts
                </a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('buttons')}}">Buttons</a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('modals')}}">Modals</a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('tables')}}">Tables</a>
              </li>
              <li
                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              >
                <a class="w-full" href="{{route('calendar')}}">Calendar</a>
              </li>
            </ul>
          </template>
        </li>        
    </ul>
</div>
