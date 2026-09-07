<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-900/10 via-gray-950 to-gray-950"></div>
    
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-amber-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(245,158,11,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            Havenella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-500 mb-4 tracking-tight relative z-10">
            EPHEMERAL PUBLIC BOARD
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Anonymous expression board with a 7-day lifecycle. Exclusively community-moderated.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "A podium devoid of history, where every concept is unshackled from digital footprints."
        </p>
    </div>

    <!-- Create Post Form -->
    <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-3xl border border-gray-800 shadow-2xl animate-fade-in-up mb-12 hover:border-amber-500/30 transition-all duration-300 relative z-10">
        <form wire:submit="createPost">
            @if($errors->has('general'))
                <div class="mb-4 p-4 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-400 text-sm font-medium">
                    {{ $errors->first('general') }}
                </div>
            @endif

            <div class="relative">
                <textarea wire:model="content" rows="3" maxlength="500" class="w-full bg-gray-950/80 border border-gray-800 rounded-2xl px-5 py-4 text-gray-200 placeholder-gray-600 focus:outline-none focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all resize-none shadow-inner" placeholder="Draft an anonymous bulletin (max 500 chars)..."></textarea>
                <div class="absolute bottom-3 right-4 text-xs font-bold text-gray-600" x-data="{ count: $wire.entangle('content').live }" x-text="count.length + '/500'"></div>
            </div>
            @error('content') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror

            <div class="mt-4 flex justify-between items-center">
                <span class="text-xs text-gray-500 font-medium">
                    <svg class="w-4 h-4 inline-block mr-1 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Payload automatically incinerated after 7 days
                </span>
                <button type="submit" wire:loading.attr="disabled" class="bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(245,158,11,0.2)] hover:shadow-[0_0_25px_rgba(245,158,11,0.4)] flex items-center gap-2 group border border-amber-400/20 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-wider text-xs">
                    <span wire:loading.remove wire:target="createPost">Broadcast</span>
                    <span wire:loading wire:target="createPost" class="animate-pulse">Processing...</span>
                    <svg wire:loading.remove wire:target="createPost" class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Timeline Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10" x-data x-on:post-created.window="$el.scrollIntoView({behavior: 'smooth'})">
        @forelse($posts as $post)
            @php
                $hasVoted = $post->votes->contains('fingerprint_hash', $fingerprint);
                $myVote = $hasVoted ? $post->votes->where('fingerprint_hash', $fingerprint)->first()->type : null;
            @endphp
            <div class="bg-gray-900/60 backdrop-blur-sm border border-gray-800 rounded-3xl p-6 hover:border-gray-700 transition-colors shadow-lg group flex flex-col justify-between" wire:key="post-{{ $post->id }}">
                <p class="text-gray-300 text-sm leading-relaxed mb-6 break-words whitespace-pre-wrap">{{ $post->content }}</p>
                
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-800/50">
                    <div class="flex items-center gap-1 bg-gray-950/80 rounded-full p-1 border border-gray-800">
                        <button wire:click="vote({{ $post->id }}, 'up')" 
                                @if($hasVoted) disabled @endif
                                class="p-1.5 rounded-full transition-colors flex items-center justify-center
                                       {{ $myVote === 'up' ? 'text-emerald-400 bg-emerald-500/10' : 'text-gray-500 hover:text-emerald-400 hover:bg-emerald-500/10' }}
                                       disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4l-8 8h6v8h4v-8h6z"/></svg>
                        </button>
                        
                        <span class="text-xs font-bold w-6 text-center {{ $post->score > 0 ? 'text-emerald-400' : ($post->score < 0 ? 'text-rose-400' : 'text-gray-400') }}">
                            {{ $post->score > 0 ? '+' : '' }}{{ $post->score }}
                        </span>
                        
                        <button wire:click="vote({{ $post->id }}, 'down')" 
                                @if($hasVoted) disabled @endif
                                class="p-1.5 rounded-full transition-colors flex items-center justify-center
                                       {{ $myVote === 'down' ? 'text-rose-400 bg-rose-500/10' : 'text-gray-500 hover:text-rose-400 hover:bg-rose-500/10' }}
                                       disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 20l8-8h-6V4h-4v8H4z"/></svg>
                        </button>
                    </div>
                    
                    <div class="text-[0.65rem] font-medium text-gray-500 uppercase tracking-widest flex items-center gap-1.5" title="Expires on {{ $post->expires_at->format('d M Y H:i') }}">
                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 py-16 text-center border border-dashed border-gray-800 rounded-3xl bg-gray-900/30">
                <div class="w-16 h-16 bg-gray-900 rounded-2xl mx-auto flex items-center justify-center text-gray-700 mb-4 border border-gray-800">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="text-gray-400 font-bold mb-1">No transmissions detected.</h3>
                <p class="text-gray-600 text-sm">Initiate the first transmission on the Havenella board.</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-12 text-center relative z-10">
        <a href="/" class="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Return to Core
        </a>
    </div>
</div>
