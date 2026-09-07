<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen flex flex-col justify-center items-center"
     x-data="{
        decryptedText: 'Decrypting transmission...',
        hasError: false,
        async initNotella(base64Payload) {
            if (!base64Payload) return;
            try {
                const hash = window.location.hash.substring(1);
                if (!hash) throw new Error('Decryption key absent from URI.');
                
                const rawKeyStr = atob(hash);
                const rawKeyArray = new Uint8Array(rawKeyStr.length);
                for (let i = 0; i < rawKeyStr.length; i++) rawKeyArray[i] = rawKeyStr.charCodeAt(i);
                
                const key = await window.crypto.subtle.importKey(
                    'raw', rawKeyArray, { name: 'AES-GCM' }, false, ['decrypt']
                );
                
                const payloadStr = atob(base64Payload);
                const payloadArray = new Uint8Array(payloadStr.length);
                for (let i = 0; i < payloadStr.length; i++) payloadArray[i] = payloadStr.charCodeAt(i);
                
                const iv = payloadArray.slice(0, 12);
                const ciphertext = payloadArray.slice(12);
                
                const decryptedBuf = await window.crypto.subtle.decrypt(
                    { name: 'AES-GCM', iv: iv }, key, ciphertext
                );
                
                this.decryptedText = new TextDecoder().decode(decryptedBuf);
            } catch (e) {
                console.error(e);
                this.hasError = true;
                this.decryptedText = 'Decryption failure. Ensure the complete URI was acquired (including fragment identifier).';
            }
        }
     }"
     @if(!$notFound) x-init="initNotella('{{ $message }}')" @endif>
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] left-[-10%] w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <div class="w-full max-w-2xl text-center mb-8">
        <a href="/" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-900/30 border border-cyan-500/30 text-cyan-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_15px_rgba(6,182,212,0.2)] hover:bg-cyan-900/50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
            Notella
        </a>
    </div>

    @if($notFound)
        <!-- Not Found View -->
        <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-center w-full max-w-2xl animate-fade-in-up">
            <div class="w-24 h-24 rounded-full bg-red-900/20 border border-red-500/20 flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600 mb-4 tracking-tight">Footprints Erased</h2>
            <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-lg mx-auto mb-8">
                Transmission undetected. It may have been previously extracted and incinerated, or this URI never existed.
            </p>
            <a href="{{ route('notella.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold text-sm transition-colors border border-gray-700 shadow-md">
                Dispatch New Transmission
            </a>
        </div>
    @else
        <!-- Message Read View -->
        <div class="bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden w-full animate-fade-in-up">
            <!-- Destruct Warning -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-red-500/20 overflow-hidden">
                <div class="h-full bg-red-600 shadow-[0_0_10px_rgba(220,38,38,0.8)]" style="width: 100%; animation: shrink 30s linear forwards;"></div>
            </div>
            <style>
                @keyframes shrink {
                    from { width: 100%; }
                    to { width: 0%; }
                }
            </style>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 pt-2 border-b border-gray-800 pb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-100 mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Transmission Breached
                    </h2>
                    <p class="text-red-400/80 text-xs font-bold tracking-wide">WARNING: DATABASE RECORD HAS BEEN INCINERATED!</p>
                </div>
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Burned
                </div>
            </div>

            <!-- Message Content -->
            <div class="bg-gray-950/50 border border-gray-800 rounded-2xl p-6 mb-8 relative group">
                <p x-text="decryptedText" :class="{'text-red-400': hasError, 'text-gray-200': !hasError}" class="text-base md:text-lg leading-relaxed whitespace-pre-wrap font-medium font-serif selection:bg-cyan-500/30"></p>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-gray-900/20 pointer-events-none rounded-2xl"></div>
            </div>

            <div class="bg-gray-950 p-5 rounded-xl border border-gray-800 flex items-start gap-4">
                <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center flex-shrink-0 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed">
                    The system has <strong>physically purged this message from the server</strong> mere moments before rendering. If this tab is closed or refreshed, the data is permanently unrecoverable. Copy the contents if retention is required.
                </p>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('notella.index') }}" class="text-cyan-500 hover:text-cyan-400 text-sm font-bold transition-colors">
                    Counter-transmit with New URI
                </a>
            </div>
        </div>
    @endif
</div>
