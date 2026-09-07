<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-blue-900/20 via-gray-950 to-gray-950"></div>
    
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-blue-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(59,130,246,0.15)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
            Pollella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-500 mb-4 tracking-tight relative z-10">
            ZERO-ID OPINION POLLS
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Public voting without accounts. Manipulation resistant. Instantaneous transparent results.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "The purest opinions are often voiced when identity is faceless."
        </p>
    </div>

    @if($generatedLink)
        <div class="bg-gray-900/80 backdrop-blur-md p-8 rounded-3xl border border-blue-500/30 shadow-2xl shadow-blue-900/10 animate-fade-in-up text-center">
            <div class="w-16 h-16 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mx-auto mb-6 text-blue-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-100 mb-2">Poll Successfully Forged!</h2>
            <p class="text-gray-400 text-[0.9rem] mb-6">Distribute the URI below. Voters require no account registration.</p>
            
            <div class="bg-gray-950/80 border border-blue-900/30 rounded-xl p-4 flex flex-col sm:flex-row items-center gap-3 mb-6 relative group overflow-hidden shadow-inner">
                <div class="absolute inset-0 bg-blue-500/5 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500"></div>
                <div class="w-full text-blue-400 text-center sm:text-left text-[0.85rem] font-mono relative z-10 break-all select-all px-2 py-1 rounded" id="pollLink" onclick="navigator.clipboard.writeText(this.innerText); alert('URI Copied!');">
                    {{ $generatedLink }}
                </div>
                <button onclick="navigator.clipboard.writeText('{{ $generatedLink }}'); alert('URI Copied!');" class="shrink-0 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-5 py-2.5 rounded-lg text-[0.8rem] font-bold tracking-wider transition-all border border-blue-500/30 relative z-10 hover:shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                    COPY URI
                </button>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ $generatedLink }}" target="_blank" class="text-blue-400 hover:text-blue-300 font-medium text-sm flex items-center gap-2 transition-colors">
                    View Poll <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <span class="hidden sm:block text-gray-700">&bull;</span>
                <button wire:click="$set('generatedLink', null)" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">
                    Forge new poll
                </button>
            </div>
        </div>
    @else
        <div class="bg-gray-900/80 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-2xl animate-fade-in-up hover:border-blue-500/30 transition-all duration-300">
            <form wire:submit="createPoll">
                @if($errors->has('general'))
                    <div class="mb-6 p-4 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-400 text-sm font-medium text-center">
                        {{ $errors->first('general') }}
                    </div>
                @endif
                
                <div class="mb-8">
                    <label class="block text-gray-400 text-sm font-bold mb-3 uppercase tracking-wider">Primary Inquiry</label>
                    <textarea wire:model="question" rows="2" class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-gray-200 placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition-all resize-none shadow-inner" placeholder="State your inquiry..."></textarea>
                    @error('question') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-gray-400 text-sm font-bold mb-3 uppercase tracking-wider">Response Options</label>
                    <div class="space-y-3">
                        @foreach($options as $index => $option)
                            <div class="flex items-center gap-2">
                                <input type="text" wire:model="options.{{ $index }}" class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-gray-200 placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition-all shadow-inner" placeholder="Option {{ $index + 1 }}">
                                @if(count($options) > 2)
                                    <button type="button" wire:click="removeOption({{ $index }})" class="p-3 text-gray-500 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all" title="Eliminate option">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @endif
                            </div>
                            @error('options.'.$index) <span class="text-rose-400 text-xs block">{{ $message }}</span> @enderror
                        @endforeach
                    </div>
                    
                    @if(count($options) < 10)
                        <button type="button" wire:click="addOption" class="mt-4 flex items-center gap-2 text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Option
                        </button>
                    @endif
                    @error('options') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-gray-400 text-sm font-bold mb-3 uppercase tracking-wider">Poll Validity Period</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer block">
                            <input type="radio" wire:model="expiresIn" value="1" class="peer absolute w-full h-full opacity-0 cursor-pointer" name="expiresIn">
                            <div class="text-center p-4 rounded-xl border border-gray-800 bg-gray-950/50 peer-checked:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 text-gray-500 transition-all hover:border-gray-700">
                                <span class="block text-lg font-bold mb-1">1</span>
                                <span class="text-xs uppercase tracking-widest font-bold">Days</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer block">
                            <input type="radio" wire:model="expiresIn" value="3" class="peer absolute w-full h-full opacity-0 cursor-pointer" name="expiresIn">
                            <div class="text-center p-4 rounded-xl border border-gray-800 bg-gray-950/50 peer-checked:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 text-gray-500 transition-all hover:border-gray-700">
                                <span class="block text-lg font-bold mb-1">3</span>
                                <span class="text-xs uppercase tracking-widest font-bold">Days</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer block">
                            <input type="radio" wire:model="expiresIn" value="7" class="peer absolute w-full h-full opacity-0 cursor-pointer" name="expiresIn">
                            <div class="text-center p-4 rounded-xl border border-gray-800 bg-gray-950/50 peer-checked:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 text-gray-500 transition-all hover:border-gray-700">
                                <span class="block text-lg font-bold mb-1">7</span>
                                <span class="text-xs uppercase tracking-widest font-bold">Days</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" wire:loading.attr="disabled" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] flex justify-center items-center gap-2 group border border-blue-400/20 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-wider text-sm">
                        <span wire:loading.remove wire:target="createPoll">Publish Poll</span>
                        <span wire:loading wire:target="createPoll" class="animate-pulse">Forging...</span>
                        <svg wire:loading.remove wire:target="createPoll" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                    <a href="/" class="p-4 rounded-xl border border-gray-800 text-gray-400 hover:text-white hover:bg-gray-800 hover:border-gray-700 transition-all flex items-center justify-center" title="Return to Core">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                </div>
            </form>
        </div>
    @endif
</div>
