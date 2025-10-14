 

<div class="max-w-2xl mx-auto  bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen  shadow-xl p-6 relative">


      <div class="fixed top-5 right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-20px] opacity-0"
            class="max-w-xs w-full border-l-4 border-{{ $color }}-500 bg-{{ $color }}-100 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200 p-4 rounded shadow-md flex items-start gap-2">
            <i class="fas fa-info-circle text-{{ $color }}-600 mt-1"></i>
            <div class="flex-1">
                <span class="font-semibold capitalize">{{ $type }}:</span>
                <span class="text-sm">{{ session($type) }}</span>
            </div>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        @endif
        @endforeach
    </div>

     
 <div class="flex flex-col items-center text-center space-y-3">

 
    @if($profilePhotoTemp)
        <img src="{{ $profilePhotoTemp }}" class="w-28 h-28 rounded-full object-cover border-4 border-blue-500 shadow-md">
    @else
        <div class="w-28 h-28 rounded-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 border-4 border-blue-500">
            <i class="fas fa-user text-5xl text-gray-500"></i>
        </div>
    @endif

 
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $name }}</h2>

    <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
        <i class="fas fa-user-circle"></i> {{ $username }}
    </p>

    @if($email)
        <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
            <i class="fas fa-envelope"></i> {{ $email }}
        </p>
    @endif

    {{-- 🛡️ Rol --}}
    <span class="px-3 py-1 rounded-full text-sm font-semibold
        {{ $role === 'Administrador' ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100' : 'bg-blue-100 text-blue-700 dark:bg-blue-700 dark:text-blue-100' }}">
        <i class="fas fa-shield-alt"></i> {{ $role }}
    </span>

     
    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300 space-y-2">
 
        @if($role === 'Docente')
            <p class="flex items-center gap-2">
                <i class="fas fa-school text-blue-500"></i> <span><strong>Escuela:</strong> {{ $escuela ?? '--' }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fas fa-layer-group text-green-500"></i>
                <span><strong>Grados asignados:</strong> {{ !empty($grados) ? implode(', ', $grados) : 'Ninguno' }}</span>
            </p>
        @endif

       
        @if($role === 'Estudiante')
            <p class="flex items-center gap-2">
                <i class="fas fa-school text-blue-500"></i> <span><strong>Escuela:</strong> {{ $escuela ?? '--' }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fas fa-book text-purple-500"></i> <span><strong>Grado:</strong> {{ $grado ?? '--' }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fas fa-users text-orange-500"></i> <span><strong>Sección:</strong> {{ $seccion ?? '--' }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fas fa-chalkboard-teacher text-green-500"></i> <span><strong>Docente:</strong> {{ $docente ?? '--' }}</span>
            </p>

            @if(!empty($accesibilidad))
                <p class="flex items-center gap-2">
                    <i class="fas fa-universal-access text-indigo-500"></i>
                    <span><strong>Accesibilidad:</strong>
                        {{ implode(' | ', array_filter([
                            !empty($accesibilidad['tts']) ? 'Texto a voz (TTS)' : null,
                            !empty($accesibilidad['high_contrast']) ? 'Alto contraste' : null
                        ])) }}
                    </span>
                </p>
            @endif
        @endif

    </div>
</div>


    {{-- Botón editar --}}
    <div class="flex justify-center mt-6">
        <button wire:click="$set('modalOpen', true)"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition flex items-center gap-2">
            <i class="fas fa-edit"></i> Editar Perfil
        </button>
    </div>

    {{-- Modal --}}
    @if($modalOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 w-full max-w-lg space-y-4 relative">
            <button wire:click="$set('modalOpen', false)" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                <i class="fas fa-times text-xl"></i>
            </button>

            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                <i class="fas fa-user-cog text-blue-600"></i> Editar Información
            </h3>

            {{-- Foto --}}
            <div class="flex items-center gap-4">
                @if($profilePhotoTemp)
                    <img src="{{ $profilePhotoTemp }}" class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full flex items-center justify-center bg-gray-200 dark:bg-gray-700">
                        <i class="fas fa-user text-3xl text-gray-500"></i>
                    </div>
                @endif
                <div>
                    <input type="file" wire:model="profile_photo_path" accept="image/*" class="block text-sm">
                    <div wire:loading wire:target="profile_photo_path" class="text-sm text-blue-500">Subiendo...</div>
                </div>
            </div>

            {{-- Campos --}}
            <div class="space-y-3">
                <div>
                    <label class="text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" wire:model="name"
                        class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

              @if($isAdmin)
                    <div>
                        <label class="text-gray-700 dark:text-gray-300">Usuario</label>
                        <input type="text" wire:model="username"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                        @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-300">Nueva Contraseña</label>
                        <input type="password" wire:model="password"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>

            {{-- Botón guardar --}}
            <div class="flex justify-end mt-6">
                <button wire:click="actualizar"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>

            @if (session('success'))
                <div class="mt-3 text-green-600 font-semibold flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mt-3 text-red-600 font-semibold flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    @endif
</div>
