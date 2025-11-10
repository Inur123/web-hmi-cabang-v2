<div class="fixed top-6 right-6 z-50 space-y-3">
    @foreach (['success', 'error', 'warning', 'info', 'status'] as $type)
        @if (session()->has($type))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-10"
                x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-10"
                class="flex items-center justify-between min-w-[280px] px-5 py-3 rounded-xl shadow-xl text-white font-medium text-sm
                    @switch($type)
@case('success')
bg-gradient-to-r from-green-500 to-emerald-600
@break

@case('error')
bg-gradient-to-r from-red-500 to-rose-600
@break

@case('warning')
bg-gradient-to-r from-amber-500 to-orange-600
@break

@case('info')
bg-gradient-to-r from-blue-500 to-cyan-600
@break

@case('status')
bg-gradient-to-r from-purple-500 to-indigo-600
@break

@default
bg-gradient-to-r from-teal-500 to-teal-600
@endswitch
                    ">
                <div class="flex items-center gap-2">
                    @switch($type)
                        @case('success')
                            <i class="fas fa-check-circle"></i>
                        @break

                        @case('error')
                            <i class="fas fa-exclamation-triangle"></i>
                        @break

                        @case('warning')
                            <i class="fas fa-exclamation-circle"></i>
                        @break

                        @case('info')
                            <i class="fas fa-info-circle"></i>
                        @break

                        @case('status')
                            <i class="fas fa-bell"></i>
                        @break

                        @default
                            <i class="fas fa-check-circle"></i>
                    @endswitch
                    <span>{{ session($type) }}</span>
                </div>
                <button @click="show = false" class="ml-3 text-white hover:text-gray-200 focus:outline-none transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    @endforeach
</div>
