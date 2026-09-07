<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <a href="{{ route('maskella.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-900/30 border border-red-500/30 text-red-400 text-xs font-bold tracking-widest uppercase mb-6 shadow-[0_0_15px_rgba(239,68,68,0.2)] hover:bg-red-900/50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Maskella
        </a>
        <h1 class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight">
            {{ $inbox->title ?: 'Classified Inbox' }}
        </h1>
        
        @if($isOwner)
            <p class="text-red-400 text-sm md:text-base font-bold max-w-2xl mx-auto leading-relaxed border border-red-500/20 bg-red-500/10 inline-block px-4 py-1.5 rounded-full shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                🔓 Private Dashboard Access Active
            </p>
        @else
            <p class="text-gray-400 text-sm md:text-base font-light max-w-2xl mx-auto leading-relaxed">
                Transmit messages without identity. Transmissions are readable solely by the inbox owner utilizing their private key.
            </p>
        @endif
    </div>

    @if($isOwner)
        <!-- Private Dashboard View -->
        <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up">
            <div class="flex items-center justify-between mb-8 border-b border-gray-800 pb-4">
                <h3 class="text-xl font-bold text-gray-100 flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    Incoming Transmissions ({{ $this->messages->count() }})
                </h3>
                <div class="text-xs text-gray-500 font-medium">
                    Expiration: {{ $inbox->expires_at->diffForHumans() }}
                </div>
            </div>

            @if($this->messages->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-800 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <p class="text-gray-500">No transmissions received yet.</p>
                    <p class="text-gray-600 text-sm mt-2">Distribute your public URI to commence receiving transmissions.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($this->messages as $msg)
                        <div class="bg-gray-950/80 border border-gray-800 p-5 rounded-2xl hover:border-gray-700 transition-colors relative group">
                            <button wire:click="deleteMessage({{ $msg->id }})" wire:confirm="Are you certain you wish to permanently incinerate this transmission?" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <p class="text-gray-300 text-sm md:text-base leading-relaxed whitespace-pre-wrap pr-8">{{ $msg->content }}</p>
                            <div class="text-xs text-gray-600 mt-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $msg->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <!-- Public Submission View -->
        <div class="bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gray-500/5 rounded-bl-full blur-2xl"></div>

            @if($successMessage)
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-500/10 text-green-400 mb-6 border border-green-500/20 shadow-[0_0_30px_rgba(34,197,94,0.2)]">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-100 mb-3">Transmission Anonymously Dispatched!</h3>
                    <p class="text-gray-400 mb-8">Your transmission is now readable solely by the owner of this inbox.</p>
                    <button wire:click="$set('successMessage', false)" class="px-6 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors font-medium border border-gray-700">
                        Dispatch Another Transmission
                    </button>
                </div>
            @else
                <form wire:submit="sendMessage" class="relative z-10 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-3">Draft Transmission (Max 2000 chars)</label>
                        <textarea wire:model="messageContent" rows="6" placeholder="Type anything... confessions, inquiries, or grievances. Your identity is 100% classified." class="w-full bg-gray-950/50 border border-gray-800 rounded-2xl p-5 text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all shadow-inner resize-none"></textarea>
                        @error('messageContent') <span class="text-red-400 text-xs mt-2 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="text-xs text-gray-500 flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            End-to-End Anonymous
                        </div>
                        <button type="submit" class="inline-flex justify-center items-center gap-2 px-8 py-3.5 bg-gray-100 hover:bg-white text-gray-900 font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                            Dispatch Transmission
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            <div wire:loading wire:target="sendMessage" class="ml-2 w-4 h-4 border-2 border-gray-900/30 border-t-gray-900 rounded-full animate-spin"></div>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    @endif
</div>
