<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen flex flex-col">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[10%] w-[500px] h-[500px] bg-amber-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <div class="flex items-center justify-between mb-8">
        <a href="/" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-900/30 border border-amber-500/30 text-amber-500 text-xs font-bold tracking-widest uppercase hover:bg-amber-900/50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Return
        </a>
        <div class="text-right">
            <h1 class="text-xl font-bold text-gray-100">{{ $box->title ?? 'Anonymous Drop Zone' }}</h1>
            <p class="text-xs text-amber-500">Auto-incinerate: {{ $box->expires_at->diffForHumans() }}</p>
        </div>
    </div>

    @if(!$isUnlocked)
        <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 max-w-md mx-auto w-full text-center shadow-2xl mt-12 animate-fade-in-up">
            <div class="w-20 h-20 rounded-full bg-gray-950 border border-gray-800 flex items-center justify-center mx-auto mb-6 text-gray-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-100 mb-2">Breach Vault</h2>
            <p class="text-gray-400 text-sm mb-6">Input the Secret Key generated during zone establishment.</p>
            
            <form wire:submit.prevent="unlock">
                <input type="password" wire:model="secretKey" class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-3 text-center text-amber-400 font-mono focus:outline-none focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all mb-4 tracking-widest" placeholder="••••••••••••••••">
                @if($error)
                    <p class="text-red-500 text-sm mb-4 font-bold">{{ $error }}</p>
                @endif
                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-gray-900 font-bold py-3 px-4 rounded-xl transition-colors shadow-lg">
                    Decrypt & Breach
                </button>
            </form>
        </div>
    @else
        <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 shadow-2xl animate-fade-in-up flex-1">
            <div class="flex items-center justify-between mb-8 border-b border-gray-800 pb-4">
                <h2 class="text-2xl font-bold text-gray-100 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    Incoming Payload Log
                </h2>
                <div class="text-sm font-bold text-gray-400">
                    Total: {{ count($files) }} payloads
                </div>
            </div>

            @if(count($files) === 0)
                <div class="text-center py-16">
                    <div class="w-16 h-16 rounded-full bg-gray-950 flex items-center justify-center mx-auto mb-4 text-gray-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <p class="text-gray-500 font-medium">No informants have transmitted payloads to this zone yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($files as $file)
                        <div class="bg-gray-950/50 border border-gray-800 rounded-2xl p-4 flex items-center justify-between group hover:border-amber-500/30 transition-colors">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-10 h-10 rounded-xl bg-gray-900 border border-gray-700 flex items-center justify-center text-gray-400 flex-shrink-0 group-hover:text-amber-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="truncate">
                                    <h4 class="text-sm font-bold text-gray-200 truncate" title="{{ $file['name'] }}">{{ $file['name'] }}</h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                        <span>{{ $file['size'] }}</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-700"></span>
                                        <span>{{ $file['created_at'] }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-shrink-0 pl-2">
                                <button wire:click="download({{ $file['id'] }})" class="p-2 bg-gray-800 hover:bg-amber-600 text-gray-300 hover:text-white rounded-lg transition-colors tooltip" title="Extract Payload">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button wire:click="deleteFile({{ $file['id'] }})" wire:confirm="Are you certain you wish to permanently incinerate this payload?" class="p-2 bg-gray-800 hover:bg-red-600 text-gray-300 hover:text-white rounded-lg transition-colors tooltip" title="Permanent Incineration">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
