<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-red-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-red-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(239,68,68,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
            Maskella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight relative z-10">
            CRYPTOGRAPHIC Q&A INBOX
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Receive inquiries and payloads anonymously. No accounts, no digital footprints.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "Identity is a liability. Here, transmissions are evaluated by their substance, not their source."
        </p>
    </div>

    @if(!$createdInbox)
        <!-- Creation Card -->
        <div class="bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/5 rounded-bl-full blur-2xl"></div>

            <form wire:submit="createInbox" class="relative z-10 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2 uppercase tracking-wider">Inbox Designation (Optional)</label>
                    <input type="text" wire:model="title" placeholder="e.g. Interrogate Me!" class="w-full bg-gray-950/50 border border-gray-800 rounded-xl px-4 py-3 text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all shadow-inner">
                    @error('title') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="bg-red-500/5 border border-red-500/20 rounded-xl p-4 flex gap-4">
                    <svg class="w-6 h-6 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>
                        <h4 class="text-sm font-bold text-red-400 mb-1">Unforgiving Security Warning</h4>
                        <p class="text-xs text-red-300/80 leading-relaxed">The architecture lacks password recovery mechanisms. Upon establishing the inbox, you must secure the provided classified URI. Losing this URI results in permanent lockout from your inbox.</p>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Forge Classified Inbox
                        <div wire:loading wire:target="createInbox" class="ml-2 w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                    </button>
                </div>
            </form>
        </div>

    @else
        <!-- Results Card -->
        <div class="bg-gray-900/80 backdrop-blur-xl border border-red-500/30 rounded-3xl p-6 md:p-8 shadow-[0_0_40px_rgba(239,68,68,0.15)] relative overflow-hidden animate-fade-in-up">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-500/10 text-green-400 mb-4 border border-green-500/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mb-2">Inbox Forged!</h3>
                <p class="text-sm text-gray-400">Copy and secure these URIs immediately.</p>
            </div>

            <div class="space-y-6">
                <!-- Public Link -->
                <div class="bg-gray-950/80 border border-gray-800 rounded-2xl p-5">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Tautan Publik (Bagikan)
                    </h4>
                    <div class="flex gap-2">
                        <input type="text" readonly value="{{ $publicLink }}" class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-2.5 text-gray-200 text-sm font-mono focus:outline-none">
                        <button onclick="navigator.clipboard.writeText('{{ $publicLink }}'); alert('Public URI Copied!')" class="shrink-0 px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-xl transition-colors font-medium text-sm border border-gray-700">
                            Copy
                        </button>
                    </div>
                    <p class="text-[0.7rem] text-gray-500 mt-2">Distribute this URI via your bio or comms channels to receive transmissions.</p>
                </div>

                <!-- Private Link -->
                <div class="bg-red-950/20 border border-red-500/30 rounded-2xl p-5 relative overflow-hidden">
                    <div class="absolute inset-0 bg-red-500/5 animate-pulse pointer-events-none"></div>
                    <h4 class="text-xs font-bold text-red-400 uppercase tracking-widest mb-3 flex items-center gap-2 relative z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        Tautan Privat (Rahasia Anda)
                    </h4>
                    <div class="flex gap-2 relative z-10">
                        <input type="text" readonly value="{{ $privateLink }}" class="w-full bg-gray-900 border border-red-500/50 rounded-xl px-4 py-2.5 text-red-200 text-sm font-mono focus:outline-none shadow-[0_0_10px_rgba(239,68,68,0.1)]">
                        <button onclick="navigator.clipboard.writeText('{{ $privateLink }}'); alert('Private URI Copied! SAFEGUARD IT!')" class="shrink-0 px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-xl transition-colors font-bold text-sm shadow-[0_0_15px_rgba(239,68,68,0.4)]">
                            Copy
                        </button>
                    </div>
                    <p class="text-[0.75rem] text-red-300/80 mt-2 font-medium relative z-10">
                        SAFEGUARD THIS URI NOW. Do not compromise it to anyone. If lost, access to your inbox will be permanently incinerated.
                    </p>
                </div>
                
                <div class="pt-4 text-center">
                    <a href="{{ $privateLink }}" class="inline-block text-sm text-gray-400 hover:text-white underline decoration-gray-600 underline-offset-4 transition-colors">Access My Dashboard Now &rarr;</a>
                </div>
            </div>
        </div>
    @endif
</div>
