<div class="max-w-3xl mx-auto px-4 py-12 relative min-h-screen flex flex-col justify-center">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-amber-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <div class="text-center mb-8 relative">
        <a href="/" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-900/30 border border-gray-700/50 text-gray-500 text-xs font-bold tracking-widest uppercase mb-6 hover:bg-gray-800 transition-colors">
            Dropella
        </a>
        <h1 class="text-2xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-2 tracking-tight">
            {{ $box->title ?? 'Anonymous Drop Zone' }}
        </h1>
        <p class="text-gray-500 text-sm md:text-base font-light max-w-lg mx-auto leading-relaxed">
            You have entered a blind drop zone. Identity tracking is disabled.
        </p>
    </div>

    <!-- Upload Zone -->
    <div class="bg-gray-900/80 backdrop-blur-xl border-2 border-dashed border-gray-800 hover:border-amber-500/50 rounded-3xl p-8 shadow-2xl relative overflow-hidden transition-colors group">
        @if($uploadSuccess)
            <div class="text-center py-8 animate-fade-in-up">
                <div class="w-20 h-20 rounded-full bg-emerald-900/30 border border-emerald-500/30 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-100 mb-2">Payload Successfully Transmitted</h2>
                <p class="text-gray-400 text-sm mb-8">Your payload has been anonymously secured within the vault. Subsequent transmitters and yourself are permanently restricted from viewing it.</p>
                <button wire:click="$set('uploadSuccess', false)" class="px-6 py-2.5 bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold rounded-xl text-sm transition-colors border border-gray-700">
                    Transmit Another Payload
                </button>
            </div>
        @else
            <div class="text-center relative"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                
                <!-- Alpine Progress State -->
                <div x-show="isUploading" style="display: none;" class="absolute inset-0 z-20 bg-gray-900/90 backdrop-blur-sm flex flex-col items-center justify-center rounded-2xl px-6">
                    <div class="w-full max-w-xs">
                        <div class="flex justify-between text-xs text-amber-400 mb-2 font-bold uppercase tracking-widest">
                            <span>Transmitting...</span>
                            <span x-text="progress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2 shadow-inner overflow-hidden">
                            <div class="bg-amber-500 h-2 rounded-full transition-all duration-300" x-bind:style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>
                </div>
                
                <div wire:loading wire:target="upload" class="absolute inset-0 z-20 bg-gray-900/90 backdrop-blur-sm flex flex-col items-center justify-center rounded-2xl">
                    <div class="w-10 h-10 border-4 border-emerald-500/30 border-t-emerald-500 rounded-full animate-spin mb-4"></div>
                    <p class="text-emerald-400 font-bold animate-pulse">Transferring covertly...</p>
                </div>

                <div class="w-20 h-20 rounded-full bg-gray-950 border border-gray-800 flex items-center justify-center mx-auto mb-6 text-gray-500 group-hover:text-amber-500 group-hover:border-amber-500/50 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </div>

                <div class="mb-6 relative">
                    <input type="file" wire:model="file" id="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <label for="file" class="block">
                        <span class="bg-gray-800 text-gray-200 px-6 py-3 rounded-xl font-bold text-sm border border-gray-700 hover:bg-gray-700 transition-colors pointer-events-none inline-block">
                            Select Payload (Max 10MB)
                        </span>
                    </label>
                </div>

                @if($file)
                    <div class="bg-amber-900/20 border border-amber-500/20 rounded-xl p-4 mb-6 inline-flex flex-col text-left max-w-sm w-full relative z-30">
                        <span class="text-xs text-amber-500 font-bold uppercase tracking-wider mb-1">Selected Payload</span>
                        <span class="text-sm text-gray-200 truncate">{{ $file->getClientOriginalName() }}</span>
                        <span class="text-xs text-gray-500 mt-1">{{ round($file->getSize() / 1024 / 1024, 2) }} MB</span>
                    </div>
                    
                    <button wire:click="saveFile" class="w-full max-w-sm mx-auto bg-amber-600 hover:bg-amber-500 text-gray-900 font-bold py-3.5 px-4 rounded-xl transition-all shadow-[0_0_20px_rgba(245,158,11,0.2)] flex items-center justify-center gap-2 relative z-30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Toss & Secure
                    </button>
                @else
                    <p class="text-gray-500 text-sm mt-4">Or drag and drop payload into this sector.</p>
                @endif
                
                @error('file') <span class="text-red-500 text-sm mt-4 block font-bold relative z-30">{{ $message }}</span> @enderror
            </div>
        @endif
    </div>
</div>
